<?php

namespace Modules\Support\Http\Controllers;

use Modules\Support\Entities\Support;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Support\Entities\SupportCategory;
use Modules\Support\Transformers\SupportTransformer;
use Modules\Support\Http\Requests\StoreSupportRequest;
use Modules\Support\Http\Requests\ListSupportQueryRequest;
use Modules\Support\Transformers\SupportCategoryTransformer;

#[OpenApi\PathItem]
class SupportController extends Controller
{
    /**
     * Display a listing of the support categories.
     */
    #[OpenApi\Operation('fetchSupportCategories', tags: ['Support'])]
    #[OpenApi\Response(factory: SupportCategoryTransformer::class)]
    #[OpenApi\Parameters(factory: ListSupportQueryRequest::class)]
    public function fetchSupportCategories(ListSupportQueryRequest $request)
    {
        $categories = SupportCategory::query()
            ->where('name', 'like', "%{$request->name}%")
            ->get();

        return SupportCategoryTransformer::collection($categories);
    }

    /**
     * Create new support request.
     */
    #[OpenApi\Operation('storeSupportRequest', tags: ['Support'])]
    #[OpenApi\Response(factory: SupportTransformer::class)]
    #[OpenApi\RequestBody(factory: StoreSupportRequest::class)]
    public function storeSupportRequest(StoreSupportRequest $request)
    {
        $support = Support::create($request->validated());

        return new SupportTransformer($support);
    }
}
