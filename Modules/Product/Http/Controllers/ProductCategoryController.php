<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Transformers\ProductCategoryTransformer;
use Modules\Product\Http\Requests\ListProductCategoriesRequest;
use Modules\Product\Http\Requests\UpdateProductCategoryRequest;

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
        return new ProductCategoryTransformer(
            $productCategory->load(['parent', 'company'])
        );
    }

    /**
     * Store a newly created product category.
     */
    #[OpenApi\Operation('storeProductCategory', tags: ['Product Categories'])]
    #[OpenApi\RequestBody(factory: UpdateProductCategoryRequest::class)]
    #[OpenApi\Response(factory: UpdateProductCategoryRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function store(UpdateProductCategoryRequest $updateProductCategoryRequest)
    {
        $productCategory = ProductCategory::create($updateProductCategoryRequest->validated());

        return new ProductCategoryTransformer(
            $productCategory->load(['parent', 'company'])
        );
    }

    /**
     * Update the specified product category.
     */
    #[OpenApi\Operation('updateProductCategory', tags: ['Product Categories'])]
    #[OpenApi\RequestBody(factory: UpdateProductCategoryRequest::class)]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function update(UpdateProductCategoryRequest $updateProductCategoryRequest, ProductCategory $productCategory)
    {
        $productCategory->update($updateProductCategoryRequest->validated());

        return new ProductCategoryTransformer(
            $productCategory->load(['parent', 'company'])
        );
    }

    /**
     * Remove the specified product category.
     */
    #[OpenApi\Operation('deleteProductCategory', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function delete(ProductCategory $productCategory, Request $request)
    {
        $productCategory->delete();

        return $this->success('Product category deleted successfully.');
    }
}