<?php

namespace Modules\Services\Http\Controllers;

use App\Models\User;
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
    #[OpenApi\Operation('createService', tags: ['Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function createService(UpdateServiceRequest $updateServiceRequest)
    {
        $user = $updateServiceRequest->user();
        $activeRole = $user->getActiveRole();
        $serviceData = $updateServiceRequest->validated();

        if ($this->isCompanyRole($activeRole)) {
            $activeCompany = $this->getActiveCompanyOrAbort($user);
            $serviceData['company_id'] = $activeCompany->id;
            $service = $activeCompany->services()->create($serviceData);
        } else {
            $serviceData['driver_id'] = $user->id;
            $service = $user->services()->create($serviceData);
        }
        $this->updateServiceDetails($service, $serviceData);

        return new ServiceTransformer($service);
    }

    /**
     * Update the specified Service.
     */
    #[OpenApi\Operation('updateService', tags: ['Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function updateService(UpdateServiceRequest $updateServiceRequest, Service $service)
    {
        $user = $updateServiceRequest->user();
        $activeRole = $user->getActiveRole();
        $serviceData = $updateServiceRequest->validated();
        if ($this->isCompanyRole($activeRole)) {
            $activeCompany = $this->getActiveCompanyOrAbort($user);
            $this->authorizeServiceForCompany($service, $activeCompany);
        } else {
            $this->authorizeServiceForDriver($service, $user);
        }

        $this->updateServiceDetails($service, $serviceData);


        return new ServiceTransformer($service);
    }

    /**
     * Remove the specified Service.
     */
    #[OpenApi\Operation('deleteService', tags: ['Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function deleteService(Request $request, Service $service)
    {
        $user = $request->user();
        $activeRole = $user->getActiveRole();

        if ($this->isCompanyRole($activeRole)) {
            $activeCompany = $this->getActiveCompanyOrAbort($user);
            $this->authorizeServiceForCompany($service, $activeCompany);
        } else {
            $this->authorizeServiceForDriver($service, $user);
        }

        $service->delete();

        return $this->success($this->getDeleteSuccessMessage($activeRole));
    }

    /**
     * Check if the active role is related to a company.
     */
    private function isCompanyRole(?object $activeRole): bool
    {
        //
        return in_array($activeRole?->name, [
            User::ROLE_COMPANY_DRIVER,
            User::ROLE_COMPANY_ADMIN,
            User::ROLE_COMPANY_OWNER,
            User::ROLE_COMPANY_MANAGER,
        ]);
    }

    /**
     * Get the active company for the user or abort if not found.
     */
    private function getActiveCompanyOrAbort($user)
    {
        $activeCompany = $user->activeCompany;

        if (! $activeCompany) {
            abort(403, 'You do not have an active company');
        }

        return $activeCompany;
    }

    /**
     * Authorize service for a company.
     */
    private function authorizeServiceForCompany(Service $service, $company)
    {
        if ($service->company_id != $company->id) {
            abort(403, 'You are not allowed to perform this action on this service');
        }
    }

    /**
     * Authorize service for a driver.
     */
    private function authorizeServiceForDriver(Service $service, $user)
    {
        if ($service->driver_id != $user->id) {
            abort(403, 'You are not allowed to perform this action on this service');
        }
    }

    /**
     * Get success message for delete action based on role.
     */
    private function getDeleteSuccessMessage(?object $activeRole): string
    {
        return $this->isCompanyRole($activeRole)
            ? 'Company service deleted successfully'
            : 'Driver service deleted successfully';
    }

    private function updateServiceDetails(Service $service, array $serviceData)
    {
        $service->update($serviceData);

        if (isset($serviceData['images'])) {
            $this->addMultipleMedia($service, $serviceData['images'], 'images', true);
        }

        if (isset($serviceData['cover'])) {
            $this->addSingleMedia($service, $serviceData['cover'], 'cover');
        }

        if (isset($serviceData['price'])) {
            $priceData = [
                'value' => $serviceData['price']['value'],
                'currency_id' => $serviceData['price']['currency_id'],
            ];
            $servicePrice = $service->prices()->first();
            if ($servicePrice) {
                $servicePrice->update($priceData);
            } else {
                $service->prices()->create($priceData);
            }
        }
    }
}
