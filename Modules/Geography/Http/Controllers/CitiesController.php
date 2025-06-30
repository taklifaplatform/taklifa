<?php

namespace Modules\Geography\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\City;
use Modules\Geography\Transformers\CityTransformer;
use Modules\Geography\Http\Requests\ListCitiesQueryRequest;

#[OpenApi\PathItem]
class CitiesController extends Controller
{
    /**
     * Display a listing of the cities.
     */
    #[OpenApi\Operation('fetchCities', tags: ['Geography'])]
    #[OpenApi\Response(factory: CityTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListCitiesQueryRequest::class)]
    public function index(ListCitiesQueryRequest $request)
    {
        return CityTransformer::collection(
            City::query()
                ->when($request->search, static function ($query, $search): void {
                    $query
                        ->where('name', 'like', sprintf('%%%s%%', $search))
                        ->orWhere('id', $search);
                })
                ->when($request->country_id, static fn($query, $country_id) => $query->where('country_id', $country_id))
                ->paginate($request->per_page ?? 10),
        );
    }
}
