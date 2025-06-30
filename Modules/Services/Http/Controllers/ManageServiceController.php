<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Services\Entities\Service;
use Modules\Services\Transformers\ServiceTransformer;
use Modules\Services\Http\Requests\UpdateServiceRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ManageServiceController extends Controller
{
    /**
     * Store new Service.
     */
    #[OpenApi\Operation('createService', tags: ['Service'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function createService(UpdateServiceRequest $updateServiceRequest)
    {
        $user = $updateServiceRequest->user();
        $ServiceData = $updateServiceRequest->validated();
        $ServiceData['user_id'] = $user->id;
        $Service = Service::create($ServiceData);

        if (isset($ServiceData['images'])) {
            $this->addMultipleMedia($Service, $ServiceData['images'], 'images', true);
        }

        return ServiceTransformer::make($Service);
    }

    /**
     * Update the specified Service.
     */
    #[OpenApi\Operation('updateService', tags: ['Service'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function updateService(UpdateServiceRequest $updateServiceRequest, Service $Service)
    {
        $user = $updateServiceRequest->user();

        if ($Service->user_id !== $user->id) {
            abort(403, 'You are not allowed to perform this action on this Service');
        }

        $ServiceData = $updateServiceRequest->validated();
        $Service->update($ServiceData);

        if (isset($ServiceData['images'])) {
            $this->addMultipleMedia($Service, $ServiceData['images'], 'images', true);
        }


        return ServiceTransformer::make($Service->refresh());
    }

    /**
     * Remove the specified Service.
     */
    #[OpenApi\Operation('deleteService', tags: ['Service'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function deleteService(Request $request, Service $Service)
    {
        $user = $request->user();

        if ($Service->user_id !== $user->id) {
            abort(403, 'You are not allowed to perform this action on this Service');
        }

        $Service->delete();

        return $this->success('Service deleted successfully');
    }
}
