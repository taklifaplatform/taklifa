<?php

namespace Modules\Services\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Services\Entities\ServiceCategory;
use Modules\Services\Transformers\ServiceCategoryTransformer;
use Modules\Services\Http\Requests\ListServiceCategoriesRequest;

#[OpenApi\PathItem]
class ServiceCategoriesController extends Controller
{
    /**
     * Display the list of Service categories
     */
    #[OpenApi\Operation('listServiceCategories', tags: ['Service'])]
    #[OpenApi\Response(factory: ServiceCategoryTransformer::class, isArray: true)]
    #[OpenApi\Parameters(factory: ListServiceCategoriesRequest::class)]
    public function listServiceCategories(ListServiceCategoriesRequest $request)
    {
        return ServiceCategoryTransformer::collection(
            ServiceCategory::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->category_id, static function ($query, $categoryId): void {
                    $query->where('parent_id', $categoryId);
                })
                ->when(!$request->category_id, static function ($query): void {
                    $query->where('parent_id', null);
                })
                ->where('enabled', true)
                ->orderBy('order', 'asc')
                ->with('enabledSubCategories')
                ->get()
        );
    }
}
