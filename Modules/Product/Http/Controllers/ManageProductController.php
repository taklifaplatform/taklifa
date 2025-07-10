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
            $product = $user->company->products()->create($request->only(
                'name',
                'description',
                'category_id',
                'is_available',
                'created_with_ai',
            ));

            // Extract variant data from nested structure
            $variantData = $request->input('variant', []);
            $product->variant()->create($variantData);
            
            // Handle images
            if ($request->has('images')) {
                $this->addMultipleMedia($product, $request->input('images'), 'images', true);
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
            // Update the product
            $product->update($request->only(
                'name',
                'description',
                'category_id',
                'is_available',
                'created_with_ai',
            ));

            // Extract variant data from nested structure
            $variantData = $request->input('variant', []);
            if (!empty($variantData)) {
                $product->variant()->update($variantData);
            }
            
            // Handle images
            if ($request->has('images')) {
                $this->addMultipleMedia($product, $request->input('images'), 'images', true);
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

}
