<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Cart\Entities\Cart;
use Modules\Cart\Entities\CartItem;
use Modules\Cart\Transformers\CartTransformer;
use Modules\Cart\Transformers\CartItemTransformer;
use Modules\Cart\Http\Requests\AddCartItemRequest;
use Modules\Product\Entities\ProductVariant;
use Illuminate\Support\Facades\DB;

#[OpenApi\PathItem]
class CartController extends Controller
{
    /**
     * Get or create cart by company_id and identifier.
     */
    #[OpenApi\Operation('getOrCreateCart', tags: ['Cart'])]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function getOrCreateCart(string $company_id, string $identifier)
    {
        // Get or create cart
        $cart = Cart::firstOrCreate(
            [
                'company_id' => $company_id,
                'device_identifier' => $identifier,
            ],
            [
                'total_items' => 0,
                'total_cost' => 0.00,
            ]
        );

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
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return CartItemTransformer::collection(
            $cart->items()->with(['product', 'variant'])->get()
        );
    }

    /**
     * Add item to cart.
     */
    #[OpenApi\Operation('addCartItem', tags: ['Cart'])]
    #[OpenApi\RequestBody(factory: AddCartItemRequest::class)]
    #[OpenApi\Response(factory: CartTransformer::class)]
    public function addCartItem(AddCartItemRequest $request, string $company_id, string $identifier)
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $company_id, $identifier) {
            // Get or create cart
            $cart = Cart::firstOrCreate(
                [
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
