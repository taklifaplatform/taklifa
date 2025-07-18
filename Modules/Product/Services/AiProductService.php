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
            return $this->createProductFromImage($image->getUrl(), $company, $batchProduct);
        } catch (\Exception $e) {
            Log::error('Product generation error: ' . $e->getMessage());
            return null;
        }
    }

    public function generateProductsFromUrls(array $imageUrls, Company $company, ?int $userId = null): array
    {
        if (!$company) {
            return $this->buildResponse(false, 'No company provided', $imageUrls);
        }

        $user = auth()->user() ?? \App\Models\User::find($userId) ?? \App\Models\User::first();

        $batchProduct = BatchProduct::create([
            'user_id' => $user->id,
            'count' => count($imageUrls),
            'published_count' => 0,
        ]);

        $products = [];
        $results = [];
        $successCount = 0;

        foreach ($imageUrls as $index => $url) {
            Log::info("Processing image #$index: $url");
            $product = $this->createProductFromImage($url, $company, $batchProduct);

            if ($product) {
                $successCount++;
                $products[] = $product->load(['variants', 'batchProduct']);
                $results[] = [
                    'success' => true,
                    'image_url' => $url,
                    'product_id' => $product->id,
                    'product_name' => $product->name
                ];
            } else {
                $results[] = [
                    'success' => false,
                    'image_url' => $url,
                    'error' => 'Failed to create product'
                ];
            }
        }

        $batchProduct->update(['published_count' => $successCount]);

        return $this->buildResponse(true, 'Product generation completed', $imageUrls, $successCount, $products, $batchProduct, $results);
    }

    private function createProductFromImage(string $imageUrl, Company $company, ?BatchProduct $batchProduct = null): ?Product
    {
        try {
            $details = $this->analyzeImageForProduct($imageUrl);

            if (!$details) return null;

            $product = $company->products()->create([
                'name' => $details['name'],
                'description' => $details['description'],
                'batch_product_id' => $batchProduct?->id,
                'created_with_ai' => true,
                'is_available' => true,
            ]);

            $this->addImageToProduct($product, $imageUrl);

            $product->variants()->create([
                'name' => $details['name'],
                'price' => $details['suggested_price'] ?? 0,
                'price_currency' => 'SAR',
                'type' => 'count',
                'stock' => 0,
            ]);

            return $product->refresh();
        } catch (\Exception $e) {
            Log::error('Product creation error: ' . $e->getMessage(), [
                'image_url' => $imageUrl,
                'company_id' => $company->id
            ]);
            return null;
        }
    }

    private function analyzeImageForProduct(string $imageUrl): ?array
    {
        try {
            $client = \OpenAI::client(env('OPENAI_API_KEY'));

            $response = $client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Analyze the image and return JSON with keys: name, description, suggested_price (USD), category. Return Arabic name/description.'
                    ],
                    [
                        'role' => 'user',
                        'content' => [
                            ['type' => 'text', 'text' => 'Analyze this image for Arabic product details'],
                            ['type' => 'image_url', 'image_url' => ['url' => $imageUrl]]
                        ]
                    ]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            $content = $response->choices[0]->message->content;

            return $this->extractJsonFromContent($content) ?? [
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

    private function extractJsonFromContent(string $content): ?array
    {
        if (preg_match('/```json\s*\n(.*?)\n```/s', $content, $match) || preg_match('/\{.*\}/s', $content, $match)) {
            $json = json_decode($match[1] ?? $match[0], true);
            return json_last_error() === JSON_ERROR_NONE ? $json : null;
        }
        return null;
    }

    private function addImageToProduct(Product $product, string $imageUrl): void
    {
        try {
            $content = file_get_contents($imageUrl);
            if (!$content) return;

            $tmp = tempnam(sys_get_temp_dir(), 'ai_img_') . '.jpg';
            file_put_contents($tmp, $content);

            $product->addMedia($tmp)->toMediaCollection('images');
            unlink($tmp);
        } catch (\Exception $e) {
            Log::warning('Image add failed: ' . $e->getMessage());
        }
    }

    private function buildResponse(
        bool $success,
        string $message,
        array $imageUrls,
        int $successCount = 0,
        array $products = [],
        ?BatchProduct $batch = null,
        array $results = []
    ): array {
        return [
            'success' => $success,
            'message' => $message,
            'total_images' => count($imageUrls),
            'successful_products' => $successCount,
            'failed_products' => count($imageUrls) - $successCount,
            'products' => $products,
            'batch_product' => $batch,
            'detailed_results' => $results
        ];
    }
}

