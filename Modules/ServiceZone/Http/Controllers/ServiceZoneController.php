<?php

namespace Modules\ServiceZone\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\ServiceZone\Entities\ServiceZone;
use Modules\ServiceZone\Transformers\ServiceZoneTransformer;
use Modules\ServiceZone\Http\Requests\ListServiceZoneRequest;
use Modules\ServiceZone\Http\Requests\UpdateServiceZoneRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ServiceZoneController extends Controller
{
    /**
     * Display the list of zone services
     */
    #[OpenApi\Operation('fetchAllZoneServices', tags: ['Zone Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ServiceZoneTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListServiceZoneRequest::class)]
    public function fetchAllZoneServices(ListServiceZoneRequest $request)
    {
        return ServiceZoneTransformer::collection(
            ServiceZone::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a zone service
     */
    #[OpenApi\Operation('retrieveZoneService', tags: ['Zone Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ServiceZoneTransformer::class)]
    public function retrieveZoneService(ServiceZone $serviceZone): ServiceZoneTransformer
    {
        return new ServiceZoneTransformer($serviceZone);
    }

    /**
     * Create new zone service.
     */
    #[OpenApi\Operation('createZoneService', tags: ['Zone Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceZoneRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceZoneRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceZoneTransformer::class)]
    public function createZoneService(UpdateServiceZoneRequest $updateServiceZoneRequest)
    {
        $user = $updateServiceZoneRequest->user();

        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            $serviceZoneData = $updateServiceZoneRequest->validated();
            $serviceZone = $activeCompany->serviceZones()->create($serviceZoneData);

            return $this->updateModelServiceZones($serviceZone, $updateServiceZoneRequest);
        } elseif ($activeRole?->name == 'solo_driver') {
            $serviceZoneData = $updateServiceZoneRequest->validated();

            $serviceZone = $user->serviceZones()->create($serviceZoneData);

            return $this->updateModelServiceZones($serviceZone, $updateServiceZoneRequest);
        }

        abort(403, 'You are not allowed to create zone service');
    }

    /**
     * Update a zone service.
     */
    #[OpenApi\Operation('updateZoneService', tags: ['Zone Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateServiceZoneRequest::class)]
    #[OpenApi\Response(factory: UpdateServiceZoneRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ServiceZoneTransformer::class)]
    public function updateZoneService(UpdateServiceZoneRequest $updateServiceZoneRequest, ServiceZone $serviceZone)
    {
        $user = $updateServiceZoneRequest->user();
        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            if (! $activeCompany->serviceZones()->find($serviceZone->id)) {
                abort(403, 'You are not allowed to update this zone service');
            }

            return $this->updateModelServiceZones($serviceZone, $updateServiceZoneRequest);
        } elseif ($activeRole?->name == 'solo_driver') {
            if (! $user->serviceZones()->find($serviceZone->id)) {
                abort(403, 'You are not allowed to update this zone service');
            }

            return $this->updateModelServiceZones($serviceZone, $updateServiceZoneRequest);
        }
    }

    /**
     * Delete a zone service
     */
    #[OpenApi\Operation('deleteZoneService', tags: ['Zone Services'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ServiceZoneTransformer::class)]
    public function deleteZoneService(Request $request, ServiceZone $serviceZone)
    {
        $user = $request->user();
        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            if (! $activeCompany->serviceZones()->find($serviceZone->id)) {
                abort(403, 'You are not allowed to delete this zone service');
            }

            $serviceZone->delete();

            return $this->success('Zone service deleted successfully');

        } elseif ($activeRole?->name == 'solo_driver') {
            if (! $user->serviceZones()->find($serviceZone->id)) {
                abort(403, 'You are not allowed to delete this zone service');
            }

            $serviceZone->delete();

            return $this->success('Zone service deleted successfully');
        }
    }

    private function updateModelServiceZones(ServiceZone $serviceZone, UpdateServiceZoneRequest $updateServiceZoneRequest): ServiceZoneTransformer
    {
        $serviceZoneData = $updateServiceZoneRequest->validated();
        $serviceZone->update($serviceZoneData);

        foreach ($serviceZoneData['areas'] as $serviceArea) {
            $serviceZone->serviceArea()->updateOrCreate(array_key_exists('id', $serviceArea) ? [
                'id' => $serviceArea['id'],
            ] : [], $serviceArea);
        }

        return new ServiceZoneTransformer($serviceZone);
    }
}
