<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Transformers\ProductCategoryTransformer;
use Modules\Product\Http\Requests\ListProductCategoriesRequest;
use Modules\Product\Http\Requests\StoreProductCategoryRequest;
use Modules\Product\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Http\Request;

#[OpenApi\PathItem]
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of product categories.
     */
    #[OpenApi\Operation('listProductCategories', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductCategoriesRequest::class)]
    public function index(ListProductCategoriesRequest $request)
    {
        $query = ProductCategory::query()
            ->with(['parent', 'children', 'company'])
            ->when($request->search, static function ($query, $search): void {
                $query->where('name', 'like', sprintf('%%%s%%', $search))
                    ->orWhere('description', 'like', sprintf('%%%s%%', $search));
            })
            ->when($request->parent_id, static fn($query, $parent_id) => $query->where('parent_id', $parent_id))
            ->when($request->company_id, static fn($query, $company_id) => $query->where('company_id', $company_id))
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc');

        return ProductCategoryTransformer::collection(
            $query->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Store a newly created product category.
     */
    #[OpenApi\Operation('storeProductCategory', tags: ['Product Categories'])]
    #[OpenApi\RequestBody(factory: UpdateProductCategoryRequest::class)]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function store(UpdateProductCategoryRequest $request)
    {
        $category = ProductCategory::create($request->validated());
        
        return new ProductCategoryTransformer($category->load(['parent', 'children', 'company']));
    }

    /**
     * Display the specified product category.
     */
    #[OpenApi\Operation('showProductCategory', tags: ['Product Categories'])]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryTransformer(
            $productCategory->load(['parent', 'children', 'company'])
        );
    }

    /**
     * Update the specified product category.
     */
    #[OpenApi\Operation('updateProductCategory', tags: ['Product Categories'])]
    #[OpenApi\RequestBody(factory: UpdateProductCategoryRequest::class)]
    #[OpenApi\Response(factory: ProductCategoryTransformer::class)]
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());
        
        return new ProductCategoryTransformer(
            $productCategory->load(['parent', 'children', 'company'])
        );
    }

    /**
     * Remove the specified product category.
     */
    #[OpenApi\Operation('deleteProductCategory', tags: ['Product Categories'])]
    public function destroy(ProductCategory $productCategory)
    {
        // Check if category has children
        if ($productCategory->children()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with subcategories'
            ], 422);
        }

        $productCategory->delete();

        return response()->json([
            'message' => 'Product category deleted successfully'
        ]);
    }
} 