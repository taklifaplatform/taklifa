<?php

namespace Modules\Geography\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Currency;
use Modules\Geography\Transformers\CurrencyTransformer;
use Modules\Geography\Http\Requests\ListCountriesQueryRequest;

#[OpenApi\PathItem]
class CurrenciesController extends Controller
{
    /**
     * Display a listing of the currencies.
     */
    #[OpenApi\Operation('listCurrencies', tags: ['Geography'])]
    #[OpenApi\Response(factory: CurrencyTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListCountriesQueryRequest::class)]
    public function listCurrencies(ListCountriesQueryRequest $request)
    {
        return CurrencyTransformer::collection(
            Currency::query()
                ->when($request->search, static function ($query, $search): void {
                    $query

                        ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('lower(title)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('lower(iso_code)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere('id', $search);
                })
                ->orderBy('sort')
                ->paginate($request->per_page ?? 30),
        );
    }

    /**
     * Retrieve the specified currency.
     */
    #[OpenApi\Operation('showCurrency', tags: ['Geography'])]
    #[OpenApi\Response(factory: CurrencyTransformer::class)]
    public function showCurrency(Request $request, Currency $currency)
    {
        return new CurrencyTransformer($currency);
    }
}
