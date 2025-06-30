<?php

namespace Modules\Geography\Http\Controllers;

use Modules\Geography\Entities\State;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Transformers\StateTransformer;
use Modules\Geography\Http\Requests\ListStatesQueryRequest;

#[OpenApi\PathItem]
class StatesController extends Controller
{
    /**
     * Display a listing of the states.
     */
    #[OpenApi\Operation('fetchStates', tags: ['Geography'])]
    #[OpenApi\Response(factory: StateTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListStatesQueryRequest::class)]
    public function index(ListStatesQueryRequest $request)
    {
        return StateTransformer::collection(
            State::query()
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
