<?php

namespace Modules\Product\Services;

use OpenAI;
use Illuminate\Support\Facades\Log;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\BatchProduct;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AiProductService
{
    public function generateProductFromImage(Media $image, Company $company, ?BatchProduct $batchProduct = null): ?Product
    {
        try {
            // Get the image URL for OpenAI Vision API
            $imageUrl = $image->getUrl();

            // Generate product details using OpenAI Vision API
            $productDetails = $this->analyzeImageForProduct($imageUrl);

            if (!$productDetails) {
                Log::error('Failed to analyze image', ['image_id' => $image->id]);
                return null;
            }

            // Create the product under the company
            $product = $company->products()->create([
                'name' => $productDetails['name'],
                'description' => $productDetails['description'],
                'batch_product_id' => $batchProduct?->id,
                'created_with_ai' => true,
                'is_available' => true,
            ]);

            // Copy the image to the product (instead of move)
            $this->copyImageToProduct($product, $image);

            // Create a default product variant
            $product->variants()->create([
                'name' => $productDetails['name'],
                'price' => $productDetails['suggested_price'] ?? 0,
                'price_currency' => 'SAR',
                'type' => 'count',
                'stock' => 0,
            ]);

            // Return the product with refreshed data
            return $product->refresh();
        } catch (\Exception $e) {
            Log::error('Product creation error: ' . $e->getMessage(), [
                'image_id' => $image->id,
                'company_id' => $company->id,
                'batch_product_id' => $batchProduct?->id
            ]);
            return null;
        }
    }

    /**
     * Copy image from batch to product
     */
    private function copyImageToProduct(Product $product, Media $image): void
    {
        try {
            // Get the image file path
            $imagePath = $image->getPath();

            if (file_exists($imagePath)) {
                // Add the image to the product using Spatie Media Library
                $product->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        } catch (\Exception $e) {
            Log::warning('Failed to copy image to product: ' . $e->getMessage());
        }
    }

    /**
     * Analyze the image using OpenAI's Vision API and generate product details with Arabic support.
     */
    private function analyzeImageForProduct(string $imageUrl): ?array
    {
        try {
            $client = OpenAI::client(env('OPENAI_API_KEY'));

            $response = $client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Analyze the image and provide product details in JSON format with keys: name, description, suggested_price (in USD), category. Make the name concise and description marketing-friendly. IMPORTANT: Provide the name and description in Arabic language (العربية). The name should be a concise Arabic product name, and the description should be a detailed marketing description in Arabic.'
                    ],
                    [
                        'role' => 'user',
                        'content' => [
                            ['type' => 'text', 'text' => 'Analyze this product image and provide details with Arabic name and description'],
                            ['type' => 'image_url', 'image_url' => ['url' => $imageUrl]]
                        ]
                    ]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            $content = $response->choices[0]->message->content;

            // Extract JSON from response
            if (preg_match('/```json\s*\n(.*?)\n```/s', $content, $matches)) {
                $json = json_decode($matches[1], true);
                if (json_last_error() === JSON_ERROR_NONE) return $json;
            }

            if (preg_match('/\{.*\}/s', $content, $matches)) {
                $json = json_decode($matches[0], true);
                if (json_last_error() === JSON_ERROR_NONE) return $json;
            }

            // Fallback response with Arabic
            return [
                'name' => 'منتج مُولد بالذكاء الاصطناعي',
                'description' => 'منتج تم إنشاؤه بواسطة الذكاء الاصطناعي من تحليل الصورة. يتميز بجودة عالية ومناسب للاستخدام اليومي.',
                'suggested_price' => 0,
                'category' => 'عام',
            ];

        } catch (\Exception $e) {
            Log::error('Image analysis error: ' . $e->getMessage());
            return null;
        }
    }
}
