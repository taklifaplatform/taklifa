<?php

namespace Modules\Cart\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Modules\Cart\Entities\Cart;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Cart\Entities\Traits\PDFHandler;

#[OpenApi\PathItem]
class PdfCartController extends Controller
{
    use PDFHandler;

    public function downloadCartInvoice(string $code, Request $request)
    {
        $cart = Cart::where('code', $code)->first();

        $cart->load(['items.product', 'items.variant', 'items.company.location']);

        $grouppedItemsByCompany = $cart->items->groupBy('company_id');

        $companies = [];

        foreach ($grouppedItemsByCompany as $companyId => $items) {
            $companies[] = (object) [
                'company' => $items->first()->company,
                'items' => $items,
                'total_cost' => $items->sum('total_price'),
            ];
        }

        $html = view('cart::pdf.invoice', compact('companies', 'cart'))->render();

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
}
