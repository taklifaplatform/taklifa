<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Cart\Entities\Cart;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Symfony\Component\HttpFoundation\Response;

#[OpenApi\PathItem]
class PdfCartController extends Controller
{
    /**
     * Download PDF invoice for cart
     */
    #[OpenApi\Operation('downloadInvoice', tags: ['Cart'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response('application/pdf', statusCode: 200)]
    public function downloadInvoice(string $cart_id, Request $request)
    {
        // Find the cart with all necessary relationships
        $cart = Cart::with([
            'user',
            'company.location',
            'company.owner',
            'items.product',
            'items.variant'
        ])->findOrFail($cart_id);

        // Check if user is authorized to view this cart
        $user = $request->user();
        if ($cart->user_id !== $user->id && !$cart->company->isCompanyMember($user)) {
            abort(403, 'Unauthorized to access this invoice');
        }

        return $this->generateInvoicePDF($cart);
    }

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
        if ($request->get('preview') === '1') {
            return $this->generateInvoiceView($cart);
        }

        return $this->generateInvoicePDF($cart);
    }

    /**
     * Simple test route for development
     */
    public function testInvoice()
    {
        // For testing - use a sample cart or create test data
        $cart = Cart::with([
            'user',
            'company.location',
            'company.owner', 
            'items.product',
            'items.variant'
        ])->first();

        if (!$cart) {
            // Return with sample data if no cart exists
            return $this->generateSampleInvoice();
        }

        return $this->generateInvoiceView($cart);
    }

    /**
     * Generate invoice view with proper data
     */
    private function generateInvoiceView($cart)
    {
        $invoiceData = $this->prepareInvoiceData($cart);
        return view('cart::pdf.invoice', $invoiceData);
    }

    /**
     * Generate PDF with proper Arabic support
     */
    private function generateInvoicePDF($cart)
    {
        $invoiceData = $this->prepareInvoiceData($cart);
        
        // Set Arabic locale
        app()->setLocale('ar');

        // Generate PDF with Arabic support
        $pdf = Pdf::loadView('cart::pdf.invoice', $invoiceData)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'dpi' => 96,
                'enable_font_subsetting' => true,
                'isJavascriptEnabled' => false,
            ]);

        $filename = 'عرض-أسعار-' . $invoiceData['quoteNumber'] . '.pdf';
        
        return $pdf->stream($filename);
    }

    /**
     * Prepare invoice data structure
     */
    private function prepareInvoiceData($cart)
    {
        $quoteNumber = str_pad($cart->id ?? 152, 3, '0', STR_PAD_LEFT);
        $currentDate = now()->format('d/m/Y');

        return [
            // Quote Information
            'quoteNumber' => $quoteNumber,
            'quoteDate' => $currentDate,
            'validityDays' => 7,
            
            // Cart and User Data
            'cart' => $cart,
            'user' => $cart->user,
            'company' => $cart->company,
            
            // Company Details
            'companyName' => $cart->company->name ?? 'مؤسسة العمرو وشركاؤه',
            'companyAddress' => $cart->company->location->address ?? '2158 طريق حمد السالم شقة رقم 47',
            'companyPhone' => $cart->company->owner->phone_number ?? '+966123456789',
            
            // Items and Pricing
            'items' => $cart->items ?? collect([]),
            'subtotal' => $cart->total_cost ? ($cart->total_cost / 100) : 0,
            'total' => $cart->total_cost ? ($cart->total_cost / 100) : 0,
            
            // Additional Data
            'userName' => $cart->user->name ?? 'وح',
            'userAvatar' => $cart->user->name ? mb_substr($cart->user->name, 0, 2) : 'وح',
        ];
    }

    /**
     * Generate sample invoice for testing
     */
    private function generateSampleInvoice()
    {
        $sampleData = [
            'quoteNumber' => '152',
            'quoteDate' => '17/07/2024',
            'validityDays' => 7,
            'companyName' => 'مؤسسة العمرو وشركاؤه',
            'companyAddress' => '2158 طريق حمد السالم شقة رقم 47',
            'companyPhone' => '+966123456789',
            'userName' => 'وحيد محمد',
            'userAvatar' => 'وح',
            'items' => collect([]),
            'subtotal' => 4107.00,
            'total' => 4107.00,
        ];

        return view('cart::pdf.invoice', $sampleData);
    }
}
