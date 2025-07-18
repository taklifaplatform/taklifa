<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test route for AI product generation
// Route::get('/test-generate-product', function () {
//     try {
//         $imageUrl = 'https://m.media-amazon.com/images/I/51VIL37W1xL._AC_SX679_.jpg';

//         $company = Company::first();
//         if (!$company) {
//             return response()->json(['error' => 'No company found'], 400);
//         }

//         $user = auth()->user() ?? User::first();
//         $batchProduct = BatchProduct::create([
//             'user_id' => $user->id,
//             'count' => 1,
//             'published_count' => 0,
//         ]);


//         $product = generateProductFromImage($imageUrl, $company, $batchProduct);

//         if (!$product) {
//             return response()->json(['error' => 'Failed to create product'], 500);
//         }

//         $batchProduct->update(['published_count' => 1]);
//         $product->load(['variants', 'batchProduct']);

//         return response()->json([
//             'success' => true,
//             'message' => 'Product successfully generated',
//             'product' => $product,
//             'batch_product' => $batchProduct
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
//         addImageToProduct($product, $imageUrl);

//         // Create a default product variant
//         $product->variants()->create([
//             'name' => $productDetails['name'],
//             'price' => $productDetails['suggested_price'] ?? 0,
//             'price_currency' => 'SAR',
//             'type' => 'count',
//             'stock' => 0,
//         ]);

//         // Return the product with refreshed data
//         return $product->refresh();
//     } catch (\Exception $e) {
//         Log::error('Product creation error: ' . $e->getMessage(), [
//             'image_url' => $imageUrl,
//             'company_id' => $company->id,
//             'batch_product_id' => $batchProduct?->id
//         ]);
//         return null;
//     }
// }

// function addImageToProduct(Product $product, string $imageUrl): void
// {
//     try {
//         $imageContent = file_get_contents($imageUrl);
//         if (!$imageContent)
//             return;

//         $tempPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
//         file_put_contents($tempPath, $imageContent);

//         $product->addMedia($tempPath)->toMediaCollection('images');
//         unlink($tempPath);

//     } catch (\Exception $e) {
//         Log::warning('Failed to add image: ' . $e->getMessage());
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

