<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Product\Entities\BatchProduct;
use Modules\Product\Services\AiProductService;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Http\Requests\BatchCreateProductRequest;
use Modules\Product\Transformers\BatchProductTransformer;
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

        $validatedData = $request->validated();
        $images = $validatedData['images'];

        if ($user->company->ai_products_limit < $images) {
            abort(403, 'You have reached the AI products limit.');
        }

        return DB::transaction(function () use ($user, $images) {


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
                    // Load relationships for the response
                    $product->load(['variants', 'media', 'batchProduct']);
                    $generatedProducts[] = $product;
                }
            }

            // Update published count
            $batchProduct->update([
                'published_count' => count($generatedProducts)
            ]);

            // Load the batch product with its relationships
            $batchProduct->load(['products.variants', 'products.media', 'media']);

            return new BatchProductTransformer($batchProduct);
        });
    }

    /**
     * Get or generate products from a batch using AI.
     */
    #[OpenApi\Operation('retrieveBatchProducts', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: BatchProductTransformer::class, isArray: true)]
    public function retrieveBatchProducts(BatchProduct $batchProduct)
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

        return BatchProductTransformer::collection($batchProduct);
    }

    /**
     * Publish a batch of products.
     */
    #[OpenApi\Operation('publishBatchProducts', tags: ['Products'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: BatchProductTransformer::class)]
    public function publishBatchProducts(BatchProduct $batchProduct)
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

        if ($batchProduct->published_count > 0) {
            abort(400, 'All products in this batch have already been published.');
        }

        $publichedCount = 0;
        foreach ($batchProduct->products as $product) {
            $product->publish();
            $publichedCount++;
        }

        $batchProduct->update([
            'published_count' => $publichedCount
        ]);

        return BatchProductTransformer::collection($batchProduct->refresh());
    }
}
