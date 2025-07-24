<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Cart\Entities\Cart;
use Modules\Cart\Entities\CartItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Entities\ProductVariant;
use Modules\Cart\Transformers\CartTransformer;
use Modules\Cart\Http\Requests\AddCartItemRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class CartController extends Controller
{
    /**
     * Get or create cart by company_id and identifier.
     */
    #[OpenApi\Operation('getCart', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function getCart(string $code, Request $request)
    {
        $user = $request->user();
        $cart = $this->getOrCreateCart($code, $user);

        return CartTransformer::make($cart->load('items.product', 'items.variant'));
    }


    /**
     * Add item to cart.
     */
    #[OpenApi\Operation('addItem', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: AddCartItemRequest::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function addItem(AddCartItemRequest $request, string $code)
    {
        $user = $request->user();
        $validated = $request->validated();

        $cart = $this->getOrCreateCart($code, $user);

        return DB::transaction(function () use ($validated, $cart) {

            $variant = ProductVariant::findOrFail($validated['variant_id']);
            $unitPrice = $variant->price;

            $existingItem = $cart->items()
                ->where('product_id', $validated['product_id'])
                ->where('variant_id', $validated['variant_id'])
                ->first();

            if ($existingItem) {
                $newQty = $validated['quantity'];

                if ($newQty <= 0) {
                    $existingItem->delete();
                } else {
                    $existingItem->update([
                        'quantity' => $newQty,
                        'total_price' => $unitPrice * $newQty,
                    ]);
                }
            } else {
                if ($validated['quantity'] > 0) {
                    $cart->items()->create([
                        'product_id' => $validated['product_id'],
                        'variant_id' => $validated['variant_id'],
                        'company_id' => $variant->product->company_id,
                        'unit_price' => $unitPrice,
                        'quantity' => $validated['quantity'],
                        'total_price' => $unitPrice * $validated['quantity'],
                    ]);
                }
            }

            $this->updateCartTotals($cart);

            return new CartTransformer($cart->load(['items.product', 'items.variant']));
        });
    }

    /**
     * Clean Cart Items
     */
    #[OpenApi\Operation('cleanCart', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function cleanCart(Request $request, string $code)
    {
        $user = $request->user();
        $cart = $this->getOrCreateCart($code, $user);
        $cart->items()->delete();
        $this->updateCartTotals($cart);
        return new CartTransformer($cart->load(['items.product', 'items.variant']));
    }

    /**
     * Get or create cart by code and associate with user if provided.
     */
    private function getOrCreateCart(string $code, $user = null): Cart
    {
        // Get or create cart
        $cart = Cart::firstOrCreate(
            [
                'code' => $code,
            ],
            [
                'user_id' => $user?->id,
                'total_items' => 0,
                'total_cost' => 0.00,
            ]
        );

        // Update user_id if user is now authenticated and cart doesn't have a user_id
        if ($user && !$cart->user_id) {
            $cart->update(['user_id' => $user->id]);
        }

        return $cart;
    }

    private function updateCartTotals(Cart $cart): void
    {
        $cart->load('items'); // ensure fresh data
        $cart->update([
            'total_items' => $cart->items->sum('quantity'),
            'total_cost' => $cart->items->sum('total_price'),
        ]);
    }
}
