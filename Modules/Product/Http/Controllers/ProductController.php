<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariant;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

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
        return new ProductTransformer(
            $product->load(['company', 'category', 'variants'])
        );
    }

    /**
     * Store a newly created product.
     */
    #[OpenApi\Operation('storeProduct', tags: ['Products'])]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function store(UpdateProductRequest $request)
    {
        $data = $request->validated();
        $variants = $data['variants'] ?? [];
        unset($data['variants']);

        return DB::transaction(function () use ($data, $variants) {
            $product = Product::create($data);

            // Create variants if provided
            if (!empty($variants)) {
                foreach ($variants as $variantData) {
                    $variantData['product_id'] = $product->id;
                    ProductVariant::create($variantData);
                }
            }

            return new ProductTransformer(
                $product->load(['company', 'category', 'variants'])
            );
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
        $data = $request->validated();
        $variants = $data['variants'] ?? null;
        unset($data['variants']);

        return DB::transaction(function () use ($product, $data, $variants) {
            $product->update($data);

            // Update variants if provided
            if ($variants !== null) {
                // Delete existing variants
                $product->variants()->delete();

                // Create new variants
                if (!empty($variants)) {
                    foreach ($variants as $variantData) {
                        $variantData['product_id'] = $product->id;
                        ProductVariant::create($variantData);
                    }
                }
            }

            return new ProductTransformer(
                $product->load(['company', 'category', 'variants'])
            );
        });
    }

    /**
     * Remove the specified product.
     */
    #[OpenApi\Operation('deleteProduct', tags: ['Products'])]
    public function deleteProduct(Product $product)
    {
        // Delete associated variants first
        $product->variants()->delete();

        $product->delete();

        return $this->success('Product deleted successfully.');
    }
}