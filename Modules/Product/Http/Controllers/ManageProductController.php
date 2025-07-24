<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Transformers\ProductTransformer;
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
    public function storeProduct(UpdateProductRequest $request)
    {
        $user = $request->user();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to create products.');
        }

        return DB::transaction(function () use ($user, $request) {
            // Get validated data
            $productData = $request->validated();

            // Create the product
            $product = $user->company->products()->create($request->only([
                'name',
                'description',
                'category_id',
                'is_available',
                'created_with_ai',
            ]));

            // Handle product variant
            if (isset($productData['variant']) && !empty($productData['variant'])) {
                $product->variant()->create($productData['variant']);
            }

            if (isset($productData['images'])) {
                $this->addMultipleMedia($product, $product['images'], 'images', true);
            }

            return new ProductTransformer($product->refresh());
        });
    }

    /**
     * Update the specified product.
     */
    #[OpenApi\Operation('updateProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $user = $request->user();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to update products.');
        }

        // Check if the product belongs to the user's company
        if ($product->company_id !== $user->company->id) {
            abort(403, 'You can only update products that belong to your company.');
        }

        return DB::transaction(function () use ($request, $product) {
            // Get validated data
            $productData = $request->validated();

            // Update the product
            $product->update($request->only([
                'name',
                'description',
                'category_id',
                'is_available',
                'created_with_ai',
            ]));

            // Handle product variant update
            if (isset($productData['variant']) && !empty($productData['variant'])) {
                if ($product->variant) {
                    $product->variant->update($productData['variant']);
                } else {
                    $product->variant()->create($productData['variant']);
                }
            }

            // Handle images using the same pattern as the example
            if (isset($productData['images'])) {
                $this->addMultipleMedia($product, $productData['images'], 'images', true);
            }

            return new ProductTransformer($product->refresh());
        });
    }

    /**
     * Publish the specified product.
     */
    #[OpenApi\Operation('publishProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function publishProduct(Product $product, Request $request)
    {
        $user = $request->user();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to publish products.');
        }

        // Check if the product belongs to the user's company
        if ($product->company_id !== $user->company->id) {
            abort(403, 'You can only publish products that belong to your company.');
        }

        // Publish the product
        $product->publish();

        return new ProductTransformer($product->refresh());
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
            // Delete all variants
            $product->variants()->delete();

            // Clear media files
            $product->clearMediaCollection('images');

            // Delete the product
            $product->delete();
        });

        return $this->success('Product deleted successfully.');
    }
}
