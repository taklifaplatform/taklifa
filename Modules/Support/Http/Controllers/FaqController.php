<?php

namespace Modules\Support\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Support\Entities\Faq;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Support\Transformers\FaqTransformer;

#[OpenApi\PathItem]
class FaqController extends Controller
{
    /**
     * Display a listing of the Faqs.
     */
    #[OpenApi\Operation('fetchListFaqs', tags: ['Faqs'])]
    #[OpenApi\Response(FaqTransformer::class, isArray: true)]
    public function fetchListFaqs(Request $request)
    {
        return FaqTransformer::collection(Faq::all());
    }
}
