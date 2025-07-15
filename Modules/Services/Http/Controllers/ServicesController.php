<?php

namespace Modules\Services\Http\Controllers;

use Modules\Api\Attributes as OpenApi;
use App\Http\Controllers\Controller;
use Modules\Services\Entities\Service;
use Modules\Services\Transformers\ServiceTransformer;
use Modules\Services\Http\Requests\ListServiceRequest;

#[OpenApi\PathItem]
class ServicesController extends Controller
{
    /**
     * Display the list of Services
     */
    #[OpenApi\Operation('listServices', tags: ['Service'])]
    #[OpenApi\Response(factory: ServiceTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListServiceRequest::class)]
    public function listServices(ListServiceRequest $request)
    {
        return ServiceTransformer::collection(
            Service::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('title', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->category_id, static function ($query, $categoryId): void {
                    $query->where('category_id', $categoryId);
                })
                ->when($request->sub_category_id, static function ($query, $subCategoryId): void {
                    $query->where('sub_category_id', $subCategoryId);
                })
                ->when($request->years, static function ($query, $years): void {
                    $years = explode(',', $years);
                    $query->whereIn('metadata->model_year', $years);
                })
                ->orderBy($request->sort_by ?? 'created_at', $request->sort_direction ?? 'desc')
                ->with('category')
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a service
     */
    #[OpenApi\Operation('retrieveService', tags: ['Service'])]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function retrieveService(Service $Service): ServiceTransformer
    {
        return new ServiceTransformer($Service);
    }
}
