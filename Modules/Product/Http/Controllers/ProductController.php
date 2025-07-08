<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Entities\Product;
use Modules\Api\Attributes as OpenApi;
use Modules\Product\Transformers\ProductTransformer;
use Modules\Product\Http\Requests\ListProductsRequest;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    #[OpenApi\Operation('fetchAllProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListProductsRequest::class)]
    public function fetchAllProduct(ListProductsRequest $request)
    {
        return ProductTransformer::collection(
            Product::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->company_id, static function ($query, $companyId): void {
                    $query->where('company_id', $companyId);
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Display the specified product.
     */
    #[OpenApi\Operation('retrieveProduct', tags: ['Products'])]
    #[OpenApi\Response(factory: ProductTransformer::class)]
    public function retrieveProduct(Product $product)
    {
        return new ProductTransformer($product);
    }
}