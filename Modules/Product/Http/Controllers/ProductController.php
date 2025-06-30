<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariant;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    #[OpenApi\Operation('listProducts', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductsRequest::class)]
    public function index(ListProductsRequest $request)
    {
        $query = Product::query()
            ->when($request->with_company, fn($query) => $query->with('company'))
            ->when($request->with_variants, fn($query) => $query->with('variants'))
            ->when($request->search, static function ($query, $search): void {
                $query->where('name', 'like', sprintf('%%%s%%', $search))
                    ->orWhere('description', 'like', sprintf('%%%s%%', $search));
            })
            ->when($request->company_id, static fn($query, $company_id) => $query->where('company_id', $company_id))
            ->orderBy('name', 'asc');

        return ProductTransformer::collection(
            $query->paginate($request->per_page ?? 10)
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
                $product->load(['company', 'variants'])
            );
        });
    }

    /**
     * Display the specified product.
     */
    #[OpenApi\Operation('showProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function show(Product $product)
    {
        return new ProductTransformer(
            $product->load(['company', 'variants'])
        );
    }

    /**
     * Update the specified product.
     */
    #[OpenApi\Operation('updateProduct', tags: ['Products'])]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function update(UpdateProductRequest $request, Product $product)
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
                $product->load(['company', 'variants'])
            );
        });
    }

    /**
     * Remove the specified product.
     */
    #[OpenApi\Operation('deleteProduct', tags: ['Products'])]
    public function destroy(Product $product)
    {
        // Delete associated variants first
        $product->variants()->delete();
        
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
} 