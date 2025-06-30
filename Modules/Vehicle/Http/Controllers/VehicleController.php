<?php

namespace Modules\Vehicle\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Attributes as OpenApi;
use App\Http\Controllers\Controller;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Transformers\VehicleTransformer;
use Modules\Vehicle\Http\Requests\UpdateVehicleRequest;
use Modules\Vehicle\Http\Requests\ListVehicleQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class VehicleController extends Controller
{
    /**
     * Display a listing of the Vehicles.
     */
    #[OpenApi\Operation('fetchAllVehicles', tags: ['Vehicles'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: VehicleTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListVehicleQueryRequest::class)]
    public function fetchAllVehicles(ListVehicleQueryRequest $request)
    {
        $user = $request->user();
        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager' || $activeRole?->name == 'company_driver') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            return VehicleTransformer::collection(
                $activeCompany->vehicles()
                    ->when($request->search, static function ($query, $search): void {
                        $query->where('plate_number', 'like', sprintf('%%%s%%', $search))
                            ->orWhere('vin_number', 'like', sprintf('%%%s%%', $search))
                            ->orWhere('color', 'like', sprintf('%%%s%%', $search))
                            ->orWhereHas('model', function ($query) use ($search) {
                                $query->where('name', 'like', sprintf('%%%s%%', $search));
                            });
                    })
                    ->paginate($request->per_page ?? 10)
            );
        } elseif ($activeRole?->name == 'solo_driver') {
            return VehicleTransformer::collection(
                $user->vehicles()
                    ->when($request->search, static function ($query, $search): void {
                        $query->where('plate_number', 'like', sprintf('%%%s%%', $search))
                            ->orWhere('vin_number', 'like', sprintf('%%%s%%', $search))
                            ->orWhere('color', 'like', sprintf('%%%s%%', $search))
                            ->orWhereHas('model', function ($query) use ($search) {
                                $query->where('name', 'like', sprintf('%%%s%%', $search));
                            });
                    })
                    ->paginate($request->per_page ?? 10)
            );
        }


        abort(403, 'You are not allowed to view vehicles ' . $activeRole?->name);
    }

    /**
     * Retrieve the specified Vehicle.
     */
    #[OpenApi\Operation('retrieveVehicle', tags: ['Vehicles'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: VehicleTransformer::class)]
    public function retrieveVehicle(Vehicle $vehicle): VehicleTransformer
    {
        return new VehicleTransformer($vehicle);
    }

    /**
     * Store a newly created Vehicle in storage.
     */
    #[OpenApi\Operation('createVehicle', tags: ['Vehicles'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateVehicleRequest::class)]
    #[OpenApi\Response(factory: UpdateVehicleRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: VehicleTransformer::class)]
    public function createVehicle(UpdateVehicleRequest $updateVehicleRequest)
    {
        $user = $updateVehicleRequest->user();
        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            $vehicleData = $updateVehicleRequest->validated();
            $vehicle = $activeCompany->vehicles()->create($vehicleData);
            $vehicle->drivers()->attach($updateVehicleRequest->user()->id);

            return $this->updateVehicleDetails($updateVehicleRequest, $vehicle, $vehicleData);
        } elseif ($activeRole?->name == 'solo_driver') {
            if ($user->vehicles()->count() > 0) {
                abort(422, 'You already have a vehicle');
            }

            $vehicleData = $updateVehicleRequest->validated();
            $vehicle = $user->vehicles()->create($vehicleData);
            $vehicle->drivers()->attach($updateVehicleRequest->user()->id);

            return $this->updateVehicleDetails($updateVehicleRequest, $vehicle, $vehicleData);
        }

        abort(403, 'You are not allowed to create a vehicle');
    }

    /**
     * Update the specified Vehicle in storage.
     */
    #[OpenApi\Operation('updateVehicle', tags: ['Vehicles'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: VehicleTransformer::class)]
    #[OpenApi\RequestBody(factory: UpdateVehicleRequest::class)]
    public function updateVehicle(UpdateVehicleRequest $updateVehicleRequest, Vehicle $vehicle)
    {
        $user = $updateVehicleRequest->user();
        $activeRole = $user->getActiveRole();

        // return $activeRole;
        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager' || $activeRole?->name == 'company_driver') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            if (! $activeCompany->vehicles()->find($vehicle->id)) {
                abort(403, 'You are not allowed to update this vehicle');
            }

            $vehicleData = $updateVehicleRequest->validated();
            $vehicle->update($vehicleData);

            return $this->updateVehicleDetails($updateVehicleRequest, $vehicle, $vehicleData);
        } elseif ($activeRole?->name == 'solo_driver') {
            if (! $user->vehicle()->find($vehicle->id)) {
                abort(403, 'You are not allowed to update this vehicle');
            }

            $vehicleData = $updateVehicleRequest->validated();
            $vehicle->update($vehicleData);

            return $this->updateVehicleDetails($updateVehicleRequest, $vehicle, $vehicleData);
        }

        abort(403, 'You are not allowed to update this vehicle');
    }

    /**
     * Delete the specified Vehicle from storage.
     */
    #[OpenApi\Operation('deleteVehicle', tags: ['Vehicles'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: VehicleTransformer::class)]
    public function deleteVehicle(Request $request, Vehicle $vehicle)
    {
        $user = $request->user();
        $activeRole = $user->getActiveRole();

        if ($activeRole?->name == 'company_owner' || $activeRole?->name == 'company_manager') {
            $activeCompany = $user->activeCompany;

            if (! $activeCompany) {
                abort(403, 'You do not have an active company');
            }

            if (! $activeCompany->vehicles()->find($vehicle->id)) {
                abort(403, 'You are not allowed to delete this vehicle');
            }

            $vehicle->delete();

            return $this->success('Vehicle deleted successfully');
        } elseif ($activeRole?->name == 'solo_driver') {
            if (! $user->vehicle()->find($vehicle->id)) {
                abort(403, 'You are not allowed to delete this vehicle');
            }

            $vehicle->delete();

            return $this->success('Vehicle deleted successfully');
        }
    }

    private function updateVehicleDetails(UpdateVehicleRequest $updateVehicleRequest, Vehicle $vehicle, array $vehicleData): VehicleTransformer
    {
        $this->addSingleMedia($vehicle, $updateVehicleRequest->get('image'), 'image');
        $this->addMultipleMedia($vehicle, $updateVehicleRequest->get('images'), 'images', true);

        $vehicle->information()->updateOrCreate(
            [
                'vehicle_id' => $vehicle->id,
            ],
            $updateVehicleRequest->get('information', [])
        );
        $vehicle->fuelInformation()->updateOrCreate(
            [
                'vehicle_id' => $vehicle->id,
            ],
            $updateVehicleRequest->get('fuel_information', [])
        );
        $vehicle->capacityDimensions()->updateOrCreate(
            [
                'vehicle_id' => $vehicle->id,
            ],
            $updateVehicleRequest->get('capacity_dimensions', [])
        );
        $vehicle->capacityWeight()->updateOrCreate(
            [
                'vehicle_id' => $vehicle->id,
            ],
            $updateVehicleRequest->get('capacity_weight', [])
        );

        return new VehicleTransformer($vehicle);
    }
}
