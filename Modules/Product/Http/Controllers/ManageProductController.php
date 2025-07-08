<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductVariant;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ManageProductController extends Controller
{
    #[OpenApi\Operation('storeProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function storeProduct(UpdateProductRequest $request)
    {
        $this->ensureUserHasCompany($request->user());

        $data = $this->prepareProductData($request);
        $variants = $data['variants'] ?? [];
        unset($data['variants']);

        return DB::transaction(function () use ($data, $variants) {
            $product = Product::create($data);
            $this->handleProductVariants($product, $variants);
            return new ProductTransformer($product);
        });
    }

    #[OpenApi\Operation('updateProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateProductRequest::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $user = $request->user();
        $this->ensureUserHasCompany($user);
        $this->ensureUserOwnsProduct($user, $product);

        $data = $this->prepareProductData($request);
        $variants = $data['variants'] ?? [];
        unset($data['variants']);

        return DB::transaction(function () use ($product, $data, $variants) {
            $product->update($data);
            $this->handleProductVariants($product, $variants);
            return new ProductTransformer($product);
        });
    }

    #[OpenApi\Operation('deleteProduct', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function deleteProduct(Product $product, Request $request)
    {
        $user = $request->user();
        $this->ensureUserHasCompany($user);
        $this->ensureUserOwnsProduct($user, $product);

        $product->delete(); // Variants will be cascade deleted by database

        return $this->success('Product deleted successfully.');
    }

    private function ensureUserHasCompany($user): void
    {
        if (!$user->company) {
            abort(403, 'User must have a company to manage products.');
        }
    }

    private function ensureUserOwnsProduct($user, Product $product): void
    {
        if ($product->company_id !== $user->company->id) {
            abort(403, 'You can only manage products that belong to your company.');
        }
    }

    private function prepareProductData(UpdateProductRequest $request): array
    {
        $data = $request->validated();
        $data['company_id'] = $request->user()->company->id;
        $data['user_id'] = $request->user()->id;
        
        return $data;
    }

    private function handleProductVariants(Product $product, array $variants): void
    {
        $product->variants()->delete();

        if (empty($variants)) return;

        $variantData = collect($variants)
            ->map(fn($variant) => [...$variant, 'product_id' => $product->id])
            ->toArray();

        ProductVariant::insert($variantData);
    }
}