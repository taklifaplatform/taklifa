<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Transformers\ProductCategoryTransformer;
use Modules\Product\Http\Requests\ListProductCategoriesRequest;

#[OpenApi\PathItem]
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of product categories.
     */
    #[OpenApi\Operation('listProductCategories', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductCategoriesRequest::class)]
    public function list(ListProductCategoriesRequest $request)
    {
        $query = ProductCategory::query()
            ->when($request->search, static function ($query, $search): void {
                $query->where('name', 'like', sprintf('%%%s%%', $search));
            })
            ->when($request->category_id, static function ($query, $categoryId): void {
                $query->where('parent_id', $categoryId);
            });
        return ProductCategoryTransformer::collection(
            $query->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Get all sub-categories for a specific parent category
     */
    #[OpenApi\Operation('retrieveSubCategories', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class, isPagination: true)]
    public function retrieve(string $parentId, ListProductCategoriesRequest $request)
    {
        // Verify parent category exists
        ProductCategory::findOrFail($parentId);

        $subCategories = ProductCategory::where('parent_id', $parentId)->get();

        return ProductCategoryTransformer::collection($subCategories);
    }
}