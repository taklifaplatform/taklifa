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
                'is_available' => false,
                'is_published' => false,
            ]);

            // Copy the image to the product (instead of move)
            $imageAdded = $this->addImageToProduct($product, $imageUrl);
            if (!$imageAdded) {
                Log::warning('Image could not be added to product, but continuing with product creation', [
                    'product_id' => $product->id,
                    'image_url' => $imageUrl
                ]);
            }

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
    private function addImageToProduct(Product $product, string $imageUrl): bool
    {
        try {
            // Get image content
            $imageContent = file_get_contents($imageUrl);
            if (!$imageContent) {
                Log::warning('Failed to download image content', ['url' => $imageUrl]);
                return false;
            }

            // Create temporary file
            $tempPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
            file_put_contents($tempPath, $imageContent);

            // Add media to product
            $product->addMedia($tempPath)->toMediaCollection('images');

            // Clean up temporary file
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }

            Log::info('Successfully added image to product', [
                'product_id' => $product->id,
                'image_url' => $imageUrl
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to add image to product: ' . $e->getMessage(), [
                'product_id' => $product->id ?? null,
                'image_url' => $imageUrl,
                'error' => $e->getMessage()
            ]);
            return false;
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
                if (json_last_error() === JSON_ERROR_NONE)
                    return $json;
            }

            if (preg_match('/\{.*\}/s', $content, $matches)) {
                $json = json_decode($matches[0], true);
                if (json_last_error() === JSON_ERROR_NONE)
                    return $json;
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
