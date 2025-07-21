<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Transformers\ProductCategoryTransformer;
use Modules\Product\Http\Requests\ListProductCategoriesRequest;
use Modules\Product\Transformers\MainProductCategoryTransformer;

#[OpenApi\PathItem]
class ProductCategoryController extends Controller
{
    /**
     * Display all parent categories.
     */
    #[OpenApi\Operation('listParentCategories', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductCategoriesRequest::class)]
    public function listParents(ListProductCategoriesRequest $request)
    {
        $query = ProductCategory::query()
            ->whereNull('parent_id')
            ->withCount('children')
            ->orderBy('order')
            ->when($request->search, static function ($query, $search): void {
                $query->where('name', 'like', sprintf('%%%s%%', $search));
            });

        return ProductCategoryTransformer::collection(
            $query->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a specific main category with categories.
     */
    #[OpenApi\Operation('retrieveMainCategory', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: MainProductCategoryTransformer::class, isPagination: false)]
    public function retrieveMainCategory(string $categoryId)
    {
        // Find the category with its sub-categories
        $category = ProductCategory::with(['children' => function($query) {
            $query->orderBy('order');
        }])
        ->withCount('children')
        ->findOrFail($categoryId);

        // Transform the category with its sub-categories
        return MainProductCategoryTransformer::make($category);
    }

    /**
     * Retrieve sub-categories for a specific main category.
     */
    #[OpenApi\Operation('retrieveSubCategories', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: MainProductCategoryTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductCategoriesRequest::class)]
    public function retrieveSubCategories(string $mainCategoryId, ListProductCategoriesRequest $request)
    {
        $query = ProductCategory::query()
            ->where('parent_id', $mainCategoryId)
            ->orderBy('order')
            ->when($request->search, static function ($query, $search): void {
                $query->where('name', 'like', sprintf('%%%s%%', $search));
            });

        return ProductCategoryTransformer::collection(
            $query->paginate($request->per_page)
        );
    }
}