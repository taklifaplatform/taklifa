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
            ->when($request->company_id, static function ($query, $companyId): void {
                $query->where('company_id', $companyId);
            })
            ->when($request->category_id, static function ($query, $categoryId): void {
                $query->where('parent_id', $categoryId);
            });
        return ProductCategoryTransformer::collection(
            $query->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Display the specified product category.
     */
    #[OpenApi\Operation('retrieveProductCategory', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function retrieve(ProductCategory $productCategory)
    {
        return new ProductCategoryTransformer($productCategory);
    }
}