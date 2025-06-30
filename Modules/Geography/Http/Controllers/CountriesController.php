<?php

namespace Modules\Geography\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Country;
use Modules\Geography\Transformers\CountryTransformer;
use Modules\Geography\Http\Requests\ListCountriesQueryRequest;

#[OpenApi\PathItem]
class CountriesController extends Controller
{
    /**
     * Display a listing of the countries.
     */
    #[OpenApi\Operation('listCountries', tags: ['Geography'])]
    #[OpenApi\Response(factory: CountryTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListCountriesQueryRequest::class)]
    public function listCountries(ListCountriesQueryRequest $request)
    {
        return CountryTransformer::collection(
            Country::query()
                ->when($request->search, static function ($query, $search): void {
                    $query
                        ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere('id', $search);
                })
                ->orderBy('sort')
                ->with('dialling')
                ->paginate($request->per_page ?? 30),
        );
    }

    /**
     * Show the specified country.
     */
    #[OpenApi\Operation('showCountry', tags: ['Geography'])]
    #[OpenApi\Response(factory: CountryTransformer::class)]
    public function showCountry(Request $request, Country $country)
    {
        return new CountryTransformer($country);
    }

    /**
     * Display the specified country by dial code.
     */
    #[OpenApi\Operation('getCountryByDialCode', tags: ['Geography'])]
    #[OpenApi\Response(factory: CountryTransformer::class)]
    public function getCountryByDialCode(Request $request, string $dialCode)
    {
        $country = Country::whereHas('dialling', function ($query) use ($dialCode) {
            $query->where('dial_code', $dialCode);
        })->first();

        return new CountryTransformer($country);
    }
}
