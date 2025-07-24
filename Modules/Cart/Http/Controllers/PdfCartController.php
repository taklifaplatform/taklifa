<?php

namespace Modules\Cart\Http\Controllers;

use Dompdf\Exception;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Modules\Cart\Entities\Cart;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Cart\Entities\Traits\PDFHandler;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class PdfCartController extends Controller
{
    use PDFHandler;

    public function downloadCartInvoice(string $code, Request $request)
    {
        $cart = Cart::where('code', $code)->first();

        $cart->load(['items.product', 'items.variant']);

        $grouppedItemsByCompany = $cart->items->groupBy('company_id');

        $companies = [];

        foreach ($grouppedItemsByCompany as $companyId => $items) {
            $companies[] = (object) [
                'company' => $items->first()->company,
                'items' => $items,
                'total_cost' => $items->sum('total_price'),
            ];
        }

        // $company = Company::find($grouppedItemsByCompany->keys()->first());


        $html = view('cart::pdf.v2-invoice', compact('companies', 'cart'))->render();

        // Apply Arabic shaping for better PDF rendering
        $html = $this->adjustArabicAndPersianContent($html);

        // Convert encoding for better Arabic support
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $pdf = app(PDF::class)
            ->loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ])->setWarnings(false);

        return $pdf->stream();
    }

    //////////////////
    /**

    /**
     * Test PDF invoice download (for web testing without auth)
     */
    public function testDownloadInvoice(string $cart_id, Request $request)
    {
        // Find the cart with all necessary relationships
        $cart = Cart::with([
            'user',
            'company.location',
            'company.owner',
            'items.product',
            'items.variant'
        ])->findOrFail($cart_id);

        // Check if we want to preview in browser or download PDF
        if ($request->get('preview') === '1' || $request->get('pdf') !== '1') {
            return $this->generateInvoiceView($cart);
        }

        return $this->generateInvoicePDF($cart);
    }

    /**
     * Simple test route for development (HTML preview)
     */
    public function testInvoice()
    {
        // Get a cart with multiple items for better testing
        $cart = Cart::with([
            'user',
            'company.location',
            'company.owner',
            'items.product',
            'items.variant'
        ])
            ->whereHas('items') // Ensure cart has items
            ->withCount('items') // Add items count
            ->orderBy('items_count', 'desc') // Order by most items first
            ->first();

        // If no cart with items found, get any cart
        if (!$cart) {
            $cart = Cart::with([
                'user',
                'company.location',
                'company.owner',
                'items.product',
                'items.variant'
            ])->first();
        }

        return $this->generateInvoiceView($cart);
    }

    /**
     * Test invoice with all cart items for a specific company
     */
    public function testInvoiceForCompany($company_id = null)
    {
        // Get company ID from parameter or use first available company
        if (!$company_id) {
            $company_id = Cart::whereHas('items')->first()->company_id ?? 1;
        }

        // Get all carts for the company with items
        $carts = Cart::with([
            'user',
            'company.location',
            'company.owner',
            'items.product',
            'items.variant'
        ])
            ->where('company_id', $company_id)
            ->whereHas('items')
            ->get();

        if ($carts->isEmpty()) {
            return response()->json(['message' => 'No carts found for this company'], 404);
        }

        // Use the first cart as base and combine all items
        $mainCart = $carts->first();

        // Collect all items from all carts for this company
        $allItems = collect();
        $totalCost = 0;

        foreach ($carts as $cart) {
            $allItems = $allItems->merge($cart->items);
            $totalCost += $cart->total_cost;
        }

        // Update the main cart with combined items and total
        $mainCart->setRelation('items', $allItems);
        $mainCart->total_cost = $totalCost;

        return $this->generateInvoiceView($mainCart);
    }

    /**
     * Generate invoice view with proper data
     */
    private function generateInvoiceView($cart)
    {
        $invoiceData = $this->prepareInvoiceData($cart);
        $html = view('cart::pdf.invoice', $invoiceData)->render();

        // Apply Arabic shaping for better PDF rendering
        $html = $this->adjustArabicAndPersianContent($html);

        // Convert encoding for better Arabic support
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $pdf = app(PDF::class)
            ->loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ])->setWarnings(false);

        return $pdf->stream();
    }

    private function generateInvoicePDF(Cart $cart)
    {
        $invoiceData = $this->prepareInvoiceData($cart);


        $html = view('cart::pdf.invoice', $invoiceData)->render();

        // Apply Arabic shaping for better PDF rendering
        $html = $this->adjustArabicAndPersianContent($html);

        // Convert encoding for better Arabic support
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $pdf = app(PDF::class)
            ->loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ])->setWarnings(false);

        return $pdf->stream();
    }


    /**
     * Prepare invoice data structure
     */
    private function prepareInvoiceData($cart)
    {
        $invoiceNumber = str_pad($cart->id ?? 152, 3, '0', STR_PAD_LEFT);
        $currentDate = now()->format('d/m/Y');

        return [
            // Invoice Information (matching blade template variables)
            'invoiceNumber' => $invoiceNumber,
            'invoiceDate' => $currentDate,
            'quoteNumber' => $invoiceNumber,
            'quoteDate' => $currentDate,
            'validityDays' => 7,


            // Cart and User Data
            'cart' => $cart,
            'user' => $cart->user,
            'company' => $cart->company,
            'totalCost' => $cart->total_cost,

            // Company Details
            'companyName' => $cart->company->name,
            'companyAddress' => $cart->company->location->address,
            'companyPhone' => $cart->company->owner->phone_number,

            // Cart Items and Products name and variant price
            'items' => $cart->items->map(function ($item) {
                // Handle product image
                $productImage = null;
                if ($item->product && $item->product->getFirstMediaUrl('images')) {
                    $imagePath = $item->product->getFirstMediaUrl('images');
                    // Convert to base64 for PDF
                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        // If it's a URL, try to get content
                        try {
                            $imageContent = @file_get_contents($imagePath);
                            if ($imageContent) {
                                $productImage = 'data:image/jpeg;base64,' . base64_encode($imageContent);
                            }
                        } catch (Exception $e) {
                            // Fallback to URL if base64 conversion fails
                            $productImage = $imagePath;
                        }
                    } else {
                        // If it's a local path
                        $fullPath = public_path($imagePath);
                        if (file_exists($fullPath)) {
                            $imageContent = file_get_contents($fullPath);
                            $productImage = 'data:image/jpeg;base64,' . base64_encode($imageContent);
                        }
                    }
                } elseif ($item->product && $item->product->image) {
                    // Fallback to product image field if exists
                    $imagePath = $item->product->image;
                    $fullPath = public_path($imagePath);
                    if (file_exists($fullPath)) {
                        $imageContent = file_get_contents($fullPath);
                        $productImage = 'data:image/jpeg;base64,' . base64_encode($imageContent);
                    }
                }

                return [
                    'name' => $item->product->name,
                    'description' => $item->product->description ?? '',
                    'price' => $item->variant->price ?? $item->product->price,
                    'type_unit' => $item->variant->type_unit ?? 'قطعة',
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,
                    'unit_price' => $item->unit_price,
                    'image' => $productImage
                ];
            }),

            // Additional Data
            'userName' => $cart->user->name,
            'userAvatar' => $cart->user->name ? mb_substr($cart->user->name, 0, 2) : 'وح',
        ];
    }

    //////////////////
}
