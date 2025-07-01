<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Api\Attributes as OpenApi;
use App\Http\Controllers\Controller;
use Modules\User\Transformers\DriverTransformer;
use Modules\User\Http\Requests\ListDriversQueryRequest;

#[OpenApi\PathItem]
class PublicDriversController extends Controller
{
    /**
     *  Fetch all drivers.
     */
    #[OpenApi\Operation('fetchAllDrivers', tags: ['Drivers'])]
    #[OpenApi\Response(factory: DriverTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListDriversQueryRequest::class)]
    public function fetchAllDrivers(ListDriversQueryRequest $request)
    {
        // return response()->json([]);
        $shouldFilterByLocation = !$request->search && $request->get('latitude') && $request->get('latitude_delta') && $request->get('longitude') && $request->get('longitude_delta');

        // $perPage = 150;
        $perPage = $request->get('per_page') ?? 20;

        if (!$shouldFilterByLocation) {
            $perPage = 100;
        }

        if ($perPage < 80) {
            $perPage = 80;
        }

        return DriverTransformer::collection(
            User::query()
                ->whereHas('roles', static function ($query): void {
                    $query->whereIn('name', [
                        User::ROLE_SOLO_DRIVER,
                        User::ROLE_COMPANY_DRIVER,
                    ]);
                })
                ->when($request->urgency_service_provider == 1, static function ($query): void {
                    $query->where('urgency_service_provider', true);
                })
                ->when(!$request->search && !$request->vehicle_model, static function ($query): void {
                    $query->where(function ($q) {
                        $q->whereHas('latestLocation', function ($q) {
                            $q->whereNotNull('latitude');
                            $q->whereNotNull('longitude');
                        })->orWhereHas('location', function ($q) {
                            $q->whereNotNull('latitude');
                            $q->whereNotNull('longitude');
                        });
                    });
                })
                ->when($request->search, static function ($query, $search): void {
                    $query->where(function ($q) use ($search) {
                        $q->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
                            ->orWhere(DB::raw('lower(username)'), 'like', '%' . strtolower($search) . '%')
                            ->orWhere(DB::raw('lower(phone_number)'), 'like', '%' . strtolower($search) . '%');
                    });
                })
                ->when($shouldFilterByLocation, function ($query) use ($request) {
                    $query->where(function ($scopeQuery) use ($request) {
                        $scopeQuery->whereHas('latestLocation', function ($q) use ($request) {
                            $q->whereBetween('latitude', [
                                (float) $request->get('latitude') - (float) $request->get('latitude_delta'),
                                (float) $request->get('latitude') + (float) $request->get('latitude_delta')
                            ]);
                            $q->whereBetween('longitude', [
                                (float) $request->get('longitude') - (float) $request->get('longitude_delta'),
                                (float) $request->get('longitude') + (float) $request->get('longitude_delta')
                            ]);
                        })->orWhereHas('location', function ($q) use ($request) {
                            $q->whereBetween('latitude', [
                                (float) $request->get('latitude') - (float) $request->get('latitude_delta'),
                                (float) $request->get('latitude') + (float) $request->get('latitude_delta')
                            ]);
                            $q->whereBetween('longitude', [
                                (float) $request->get('longitude') - (float) $request->get('longitude_delta'),
                                (float) $request->get('longitude') + (float) $request->get('longitude_delta')
                            ]);
                        });
                    });
                })
                ->with([
                    'ratings',
                    'media',
                    'roles',
                    'companies',
                    'companies.media',
                    'location',
                    'location.city',
                    'location.state',
                    'location.country',
                    'latestLocation',

                ])
                ->paginate($perPage)
        );
    }

    /**
     *  Retrieve a driver.
     */
    #[OpenApi\Operation('retrieveDriver', tags: ['Drivers'])]
    #[OpenApi\Response(factory: DriverTransformer::class)]
    public function retrieveDriver(User $driver): DriverTransformer
    {
        return new DriverTransformer($driver);
    }
}
