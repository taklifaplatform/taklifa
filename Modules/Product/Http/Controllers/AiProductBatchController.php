<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\BatchProduct;
use Modules\Product\Services\AiProductService;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Http\Requests\BatchCreateProductRequest;
use Modules\Product\Transformers\BatchProductTransformer;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class AiProductBatchController extends Controller
{
    public function __construct(
        private AiProductService $aiProductService
    ) {}

    /**
     * Create a new batch of products using AI with provided images.
     */
    #[OpenApi\Operation('batchCreateProducts', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: BatchCreateProductRequest::class)]
    #[OpenApi\Response(factory: BatchProductTransformer::class)]
    public function batchCreate(BatchCreateProductRequest $request)
    {
        $user = $request->user();

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to create products.');
        }

        return DB::transaction(function () use ($user, $request) {
            $validatedData = $request->validated();
            $images = $validatedData['images'];

            // Create the batch product
            $batchProduct = BatchProduct::create([
                'user_id' => $user->id,
                'count' => count($images),
                'published_count' => 0,
            ]);

            // Attach images to the batch product for processing
            if ($images) {
                $this->addMultipleMedia($batchProduct, $images, 'images', true);
            }

            // Auto-generate products from each image using OpenAI
            $attachedImages = $batchProduct->getMedia('images');
            $generatedProducts = [];

            foreach ($attachedImages as $image) {
                $product = $this->aiProductService->generateProductFromImage(
                    $image,
                    $user->company,
                    $batchProduct
                );

                if ($product) {
                    $generatedProducts[] = $product;
                }
            }

            // Update published count
            $batchProduct->update([
                'published_count' => count($generatedProducts)
            ]);

            return new BatchProductTransformer($batchProduct->load('products'));
        });
    }

    /**
     * Get or generate products from a batch using AI.
     */
    #[OpenApi\Operation('generateProductsFromBatch', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProductTransformer::class, isArray: true)]
    public function generateProducts(BatchProduct $batchProduct)
    {
        $user = request()->user();

        // Ensure user owns the batch
        if ($batchProduct->user_id !== $user->id) {
            abort(403, 'You do not have permission to access this batch.');
        }

        // Ensure user has a company
        if (!$user->company) {
            abort(403, 'User must have a company to create products.');
        }

        return DB::transaction(function () use ($batchProduct, $user) {
            // Check if products already exist for this batch
            $existingProducts = $batchProduct->products()->get();

            if ($existingProducts->count() > 0) {
                // Return existing products
                return ProductTransformer::collection($existingProducts);
            }

            // If no products exist, generate new ones
            $images = $batchProduct->getMedia('images');
            $generatedProducts = [];

            foreach ($images as $image) {
                $product = $this->aiProductService->generateProductFromImage(
                    $image,
                    $user->company,
                    $batchProduct
                );

                if ($product) {
                    $generatedProducts[] = $product;
                }
            }

            // Update published count
            $batchProduct->update([
                'published_count' => count($generatedProducts)
            ]);

            return ProductTransformer::collection($generatedProducts);
        });
    }
}