<?php

// use App\Models\User;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Log;
// use OpenAI;
// use Modules\Company\Entities\Company;
// use Modules\Product\Entities\Product;
// use Modules\Product\Entities\BatchProduct;
// use Modules\Product\Transformers\ProductTransformer;
// use Modules\Product\Transformers\BatchProductTransformer;

// // /*
// // |--------------------------------------------------------------------------
// // | Web Routes
// // |--------------------------------------------------------------------------
// // |
// // | Here is where you can register web routes for your application. These
// // | routes are loaded by the RouteServiceProvider within a group which
// // | contains the "web" middleware group. Now create something great!
// // |
// // */

// // // Test route for AI product generation
// Route::get('/test-generate-product', function () {
//     try {
//         $imageUrl = [
//             'https://m.media-amazon.com/images/I/51VIL37W1xL._AC_SX679_.jpg',
//             'https://m.media-amazon.com/images/I/61KIPhGBxxL.__AC_SX300_SY300_QL70_ML2_.jpg',
//             'https://m.media-amazon.com/images/I/61UK-ufKOSL.__AC_SX300_SY300_QL70_ML2_.jpg',
//             'https://m.media-amazon.com/images/I/51FLQk427sL.__AC_SX300_SY300_QL70_ML2_.jpg',
//         ];

//         $company = Company::first();
//         if (!$company) {
//             return response()->json(['error' => 'No company found'], 400);
//         }

//         $user = auth()->user() ?? User::first();
//         $batchProduct = BatchProduct::create([
//             'user_id' => $user->id,
//             'count' => count($imageUrl),
//             'published_count' => 0,
//         ]);


//         $createdProducts = [];
//         $successCount = 0;

//         foreach ($imageUrl as $index => $singleImageUrl) {
//             $product = generateProductFromImage($singleImageUrl, $company, $batchProduct);
//             if ($product) {
//                 // Load all necessary relationships including media
//                 $product->load(['variants', 'batchProduct', 'media', 'company']);
//                 $createdProducts[] = $product;
//                 $successCount++;
//                 $batchProduct->increment('published_count');
//             }
//         }

//         if (empty($createdProducts)) {
//             return response()->json(['error' => 'Failed to create any products'], 500);
//         }

//         // Load batch product with relationships
//         $batchProduct->load(['products.media', 'products.variants', 'products.company']);

//         return response()->json([
//             'success' => true,
//             'message' => "Successfully generated {$successCount} out of " . count($imageUrl) . " products",
//             'products' => ProductTransformer::collection(collect($createdProducts)),
//             'batch_product' => new BatchProductTransformer($batchProduct->fresh()),
//             'created_count' => $successCount,
//             'total_attempted' => count($imageUrl)
//         ]);

//     } catch (\Exception $e) {
//         Log::error('Product generation error: ' . $e->getMessage());
//         return response()->json(['error' => 'Generation failed: ' . $e->getMessage()], 500);
//     }
// });

// function generateProductFromImage(string $imageUrl, Company $company, ?BatchProduct $batchProduct = null): ?Product
// {
//     try {
//         // Generate product details using OpenAI Vision API
//         $productDetails = analyzeImageForProduct($imageUrl);

//         if (!$productDetails) {
//             Log::error('Failed to analyze image', ['image_url' => $imageUrl]);
//             return null;
//         }

//         // Create the product under the company
//         $product = $company->products()->create([
//             'name' => $productDetails['name'],
//             'description' => $productDetails['description'],
//             'batch_product_id' => $batchProduct?->id,
//             'created_with_ai' => true,
//             'is_available' => true,
//         ]);

//         // Add the image to the product
//         $imageAdded = addImageToProduct($product, $imageUrl);
//         if (!$imageAdded) {
//             Log::warning('Image could not be added to product, but continuing with product creation', [
//                 'product_id' => $product->id,
//                 'image_url' => $imageUrl
//             ]);
//         }

//         // Create a default product variant
//         $product->variants()->create([
//             'name' => $productDetails['name'],
//             'price' => $productDetails['suggested_price'] ?? 0,
//             'price_currency' => 'SAR',
//             'type' => 'count',
//             'stock' => 0,
//         ]);

//         // Return the product with refreshed data and media loaded
//         return $product->fresh(['variants', 'media', 'company']);
//     } catch (\Exception $e) {
//         Log::error('Product creation error: ' . $e->getMessage(), [
//             'image_url' => $imageUrl,
//             'company_id' => $company->id,
//             'batch_product_id' => $batchProduct?->id
//         ]);
//         return null;
//     }
// }

// function addImageToProduct(Product $product, string $imageUrl): bool
// {
//     try {
//         // Get image content
//         $imageContent = file_get_contents($imageUrl);
//         if (!$imageContent) {
//             Log::warning('Failed to download image content', ['url' => $imageUrl]);
//             return false;
//         }

//         // Create temporary file
//         $tempPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
//         file_put_contents($tempPath, $imageContent);

//         // Add media to product
//         $product->addMedia($tempPath)->toMediaCollection('images');

//         // Clean up temporary file
//         if (file_exists($tempPath)) {
//             unlink($tempPath);
//         }

//         Log::info('Successfully added image to product', [
//             'product_id' => $product->id,
//             'image_url' => $imageUrl
//         ]);

//         return true;

//     } catch (\Exception $e) {
//         Log::error('Failed to add image to product: ' . $e->getMessage(), [
//             'product_id' => $product->id ?? null,
//             'image_url' => $imageUrl,
//             'error' => $e->getMessage()
//         ]);
//         return false;
//     }
// }

// function analyzeImageForProduct(string $imageUrl): ?array
// {
//     try {
//         $client = OpenAI::client(env('OPENAI_API_KEY'));

//         $response = $client->chat()->create([
//             'model' => 'gpt-4o-mini',
//             'messages' => [
//                 [
//                     'role' => 'system',
//                     'content' => 'Analyze the image and provide product details in JSON format with keys: name, description, suggested_price (in USD), category. Make the name concise and description marketing-friendly. IMPORTANT: Provide the name and description in Arabic language (العربية). The name should be a concise Arabic product name, and the description should be a detailed marketing description in Arabic.'
//                 ],
//                 [
//                     'role' => 'user',
//                     'content' => [
//                         ['type' => 'text', 'text' => 'Analyze this product image and provide details with Arabic name and description'],
//                         ['type' => 'image_url', 'image_url' => ['url' => $imageUrl]]
//                     ]
//                 ]
//             ],
//             'max_tokens' => 500,
//             'temperature' => 0.7,
//         ]);

//         $content = $response->choices[0]->message->content;

//         // Extract JSON from response
//         if (preg_match('/```json\s*\n(.*?)\n```/s', $content, $matches)) {
//             $json = json_decode($matches[1], true);
//             if (json_last_error() === JSON_ERROR_NONE)
//                 return $json;
//         }

//         if (preg_match('/\{.*\}/s', $content, $matches)) {
//             $json = json_decode($matches[0], true);
//             if (json_last_error() === JSON_ERROR_NONE)
//                 return $json;
//         }

//         // Fallback response with Arabic
//         return [
//             'name' => 'منتج مُولد بالذكاء الاصطناعي',
//             'description' => 'منتج تم إنشاؤه بواسطة الذكاء الاصطناعي من تحليل الصورة. يتميز بجودة عالية ومناسب للاستخدام اليومي.',
//             'suggested_price' => 0,
//             'category' => 'عام',
//         ];

//     } catch (\Exception $e) {
//         Log::error('Image analysis error: ' . $e->getMessage());
//         return null;
//     }
// }

