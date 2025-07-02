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
use Modules\Cart\Transformers\CartItemTransformer;
use Modules\Cart\Http\Requests\AddCartItemRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class CartController extends Controller
{
    /**
     * Get or create cart by company_id and identifier.
     */
    #[OpenApi\Operation('getOrCreateCart', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function getOrCreateCart(string $company_id, string $identifier, Request $request)
    {
        $user = $request->user();
        // Get or create cart
        $cart = Cart::firstOrCreate(
            [
                'user_id' => $user ? $user->id : null,
                'company_id' => $company_id,
                'device_identifier' => $identifier,
            ],
            [
               'user_id' => $user ? $user->id : null,
                'total_items' => 0,
                'total_cost' => 0.00,
            ]
        );

        // Update user_id if user is now authenticated and cart doesn't have a user_id
        if ($user && !$cart->user_id) {
            $cart->update(['user_id' => $user->id]);
        }

        return new CartTransformer($cart->load('items.product', 'items.variant'));
    }

    /**
     * Get cart items.
     */
    #[OpenApi\Operation('getCartItems', tags: ['Cart'])]
    #[OpenApi\Response(factory: CartItemTransformer::class, isPagination: false)]
    public function getCartItems(string $company_id, string $identifier)
    {
        $cart = Cart::where('company_id', $company_id)
            ->where('device_identifier', $identifier)
            ->first();

        if (!$cart) {
            abort(404, 'Cart not found');
        }

        return CartItemTransformer::collection(
            $cart->items()->with(['product', 'variant'])->get()
        );
    }

    /**
     * Add item to cart.
     */
    #[OpenApi\Operation('addCartItem', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: AddCartItemRequest::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function addCartItem(AddCartItemRequest $request, string $company_id, string $identifier)
    {
        $user = $request->user();
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $company_id, $identifier, $user) {
            // Get or create cart
            $cart = Cart::firstOrCreate(
                [
                    'user_id' => $user ? $user->id : null,
                    'company_id' => $company_id,
                    'device_identifier' => $identifier,
                ],
                [
                    'total_items' => 0,
                    'total_cost' => 0.00,
                ]
            );

            // Get variant price
            $variant = ProductVariant::findOrFail($validated['variant_id']);
            $unitPrice = $variant->price;

            // Check if item already exists in cart
            $existingItem = $cart->items()
                ->where('product_id', $validated['product_id'])
                ->where('variant_id', $validated['variant_id'])
                ->first();

            if ($existingItem) {
                // Update existing item
                $newQuantity = $existingItem->quantity + $validated['quantity'];

                if ($newQuantity <= 0) {
                    // Remove item if quantity is 0 or less
                    $existingItem->delete();
                } else {
                    // Update quantity and total price
                    $existingItem->update([
                        'quantity' => $newQuantity,
                        'total_price' => $unitPrice * $newQuantity,
                    ]);
                }
            } else {
                // Create new item only if quantity is greater than 0
                if ($validated['quantity'] > 0) {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'user_id' => $user ? $user->id : null,
                        'product_id' => $validated['product_id'],
                        'variant_id' => $validated['variant_id'],
                        'unit_price' => $unitPrice,
                        'quantity' => $validated['quantity'],
                        'total_price' => $unitPrice * $validated['quantity'],
                    ]);
                }
            }

            // Recalculate cart totals
            $this->recalculateCartTotals($cart);

            return new CartTransformer($cart->load('items.product', 'items.variant'));
        });
    }

    /**
     * Recalculate cart totals.
     */
    private function recalculateCartTotals(Cart $cart): void
    {
        $items = $cart->items;
        $totalItems = $items->sum('quantity');
        $totalCost = $items->sum('total_price');

        $cart->update([
            'total_items' => $totalItems,
            'total_cost' => $totalCost,
        ]);
    }
}
