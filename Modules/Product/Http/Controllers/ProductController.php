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
        $query = Product::query();

        if (!$request->include_unpublished) {
            // should be published
            $query->where('is_published', true);
            $query->where('is_available', true);
            // price should be bigger than 0
            $query->whereHas('variant', function ($q) {
                $q->where('price', '>', 0);
            });
        }

        return ProductTransformer::collection(
            $query
                ->latest()
                ->with('variant')
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->company_id, static function ($query, $companyId): void {
                    $query->where('company_id', $companyId);
                })
                ->when($request->min_price, static function ($query, $minPrice): void {
                    $query->whereHas('variant', function ($q) use ($minPrice) {
                        $q->where('price', '>=', $minPrice);
                    });
                })
                ->when($request->max_price, static function ($query, $maxPrice): void {
                    $query->whereHas('variant', function ($q) use ($maxPrice) {
                        $q->where('price', '<=', $maxPrice);
                    });
                })
                ->when($request->order_by, static function ($query, $orderBy) use ($request): void {
                    if ($orderBy === 'price') {
                        $query->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                            ->orderBy('product_variants.price', $request->order_direction ?? 'desc')
                            ->select('products.*');
                    } else {
                        $query->orderBy($orderBy, $request->order_direction ?? 'desc');
                    }
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
