<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductVariant;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    #[OpenApi\Operation('fetchAllProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductsRequest::class)]
    public function fetchAllProduct(ListProductsRequest $request)
    {
        return ProductTransformer::collection(
            Product::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->company_id, static function ($query, $companyId): void {
                    $query->where('company_id', $companyId);
                })
                ->when($request->category_id, static function ($query, $categoryId): void {
                    $query->where('category_id', $categoryId);
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Display the specified product.
     */
    #[OpenApi\Operation('retrieveProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function retrieveProduct(Product $product)
    {
        return new ProductTransformer($product);
    }

    /**
     * Store a newly created product.
     */
    #[OpenApi\Operation('storeProduct', tags: ['Products'])]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function store(UpdateProductRequest $request)
    {
        $validatedData = $request->validated();
        $variants = $validatedData['variants'] ?? [];
        unset($validatedData['variants']);

        return DB::transaction(function () use ($validatedData, $variants) {
            // Create the product
            $product = Product::create($validatedData);

            // Create variants if provided
            if (!empty($variants)) {
                $this->createProductVariants($product, $variants);
            }

            return new ProductTransformer($product);
        });
    }

    /**
     * Update the specified product.
     */
    #[OpenApi\Operation('updateProduct', tags: ['Products'])]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $variants = $validatedData['variants'] ?? null;
        unset($validatedData['variants']);

        return DB::transaction(function () use ($product, $validatedData, $variants) {
            // Update the product
            $product->update($validatedData);

            // Update variants if provided
            if ($variants !== null) {
                $this->updateProductVariants($product, $variants);
            }

            return new ProductTransformer($product->fresh());
        });
    }

    /**
     * Remove the specified product.
     */
    #[OpenApi\Operation('deleteProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function deleteProduct(Product $product, Request $request)
    {
        $product->delete();

        return $this->success('Product deleted successfully.');
    }

    /**
     * Create product variants for a given product.
     */
    private function createProductVariants(Product $product, array $variants): void
    {
        foreach ($variants as $variantData) {
            $variantData['product_id'] = $product->id;
            ProductVariant::create($variantData);
        }
    }

    /**
     * Update product variants for a given product.
     */
    private function updateProductVariants(Product $product, array $variants): void
    {
        // Delete existing variants
        $product->variants()->delete();

        // Create new variants if provided
        if (!empty($variants)) {
            $this->createProductVariants($product, $variants);
        }
    }
}