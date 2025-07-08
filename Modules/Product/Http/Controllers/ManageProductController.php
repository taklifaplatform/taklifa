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
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ManageProductController extends Controller
{
    /**
     * Store a newly created product.
     */
    #[OpenApi\Operation('storeProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function storeProduct(UpdateProductRequest $updateProductRequest)
    {
        $user = $updateProductRequest->user();
        $validatedData = $updateProductRequest->validated();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to create products.');
        }

        // Set company_id from user's company
        $validatedData['company_id'] = $user->company->id;
        $validatedData['user_id'] = $user->id;

        $variants = $validatedData['variants'] ?? [];
        unset($validatedData['variants']);

        return DB::transaction(function () use ($validatedData, $variants) {
            $product = Product::create($validatedData);
            $this->createProductVariants($product, $variants);
            return new ProductTransformer($product);
        });


    }

    /**
     * Update the specified product.
     */
    #[OpenApi\Operation('updateProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function updateProduct(UpdateProductRequest $updateProductRequest, Product $product)
    {
        $user = $updateProductRequest->user();
        $validatedData = $updateProductRequest->validated();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to update products.');
        }

        // Check if the product belongs to the user's company
        if ($product->company_id !== $user->company->id) {
            abort(403, 'You can only update products that belong to your company.');
        }

        // Set company_id from user's company
        $validatedData['company_id'] = $user->company->id;
        $validatedData['user_id'] = $user->id;

        $variants = $validatedData['variants'] ?? [];
        unset($validatedData['variants']);

        return DB::transaction(function () use ($product, $validatedData, $variants) {
            // Update the product
            $product->update($validatedData);

            // Update variants if provided
            if (!empty($variants)) {
                $this->updateProductVariants($product, $variants);
            } else {
                // If no variants provided, delete existing ones
                $product->variants()->delete();
            }
            return new ProductTransformer($product);
        });
    }

    /**
     * Remove the specified product.
     */
    #[OpenApi\Operation('deleteProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function deleteProduct(Product $product, Request $request)
    {
        $user = $request->user();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to delete products.');
        }
        // Check if the product belongs to the user's company
        if ($product->company_id !== $user->company->id) {
            abort(403, 'You can only delete products that belong to your company.');
        }

        // Delete the product and its variants
        DB::transaction(function () use ($product) {
            // Delete variants first
            $product->variants()->delete();
            // Then delete the product
            $product->delete();
        });

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