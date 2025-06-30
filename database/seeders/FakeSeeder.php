<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Company\Entities\Company;
use Modules\Geography\Entities\State;
use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Entities\ChatChannel;
use Modules\Rating\Entities\RatingType;
use Modules\Vehicle\Entities\VehicleModel;
use Modules\Shipment\Entities\ShipmentInvitation;
use Modules\Shipment\ShipmentHelper\ShipmentHelper;


class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSoloDrivers();

        $this->createCompanyOwners();

        $this->createChat();

        $this->addAvatarsToAllUsers();

        $this->createShipments();

        $this->addLocationsToDrivers();
    }

    public function addLocationsToDrivers()
    {
        $drivers = User::query()
            ->whereHas('roles', static function ($query): void {
                $query->whereIn('name', [
                    User::ROLE_SOLO_DRIVER,
                    User::ROLE_COMPANY_DRIVER,
                ]);
            })->get();
        foreach ($drivers as $driver) {
            $address = fake()->address();
            // remove any break lines
            $address = Str::of($address)->replace('\n', ', ')->toString();
            $driver->location_id = $driver->locations()->create([
                'country_id' => 185,
                'address' => $address,
                'latitude' => fake()->latitude(24.5, 24.9),
                'longitude' => fake()->longitude(46.6, 46.97),
            ])->id;
            $driver->save();
        }
    }

    public function createShipments()
    {
        $statuses = [
            'draft',
            'searching',
            'assigned',
            'delivering',
            'delivered',
            'cancelled',
        ];
        $itemsTypes = [
            'document',
            'box',
            'multiple_boxes',
            'other',
        ];

        $users = User::query()->limit(5)->get();
        $saudiStates = State::query()->where('country_id', 185)->get();
        foreach ($users as $user) {
            for ($i = 0; $i < rand(2, 4); $i++) {
                $state = fake()->randomElement($saudiStates);
                $pickDate = now()->addDays(rand(3, 10));
                $deliverDate = $pickDate->copy()->addDays(rand(3, 10));
                $shipment = $user->shipments()->create([
                    'pick_date' => $pickDate,
                    'pick_time' => $pickDate,
                    'deliver_date' => $deliverDate,
                    'deliver_time' => $deliverDate,
                    'recipient_name' => fake()->name(),
                    'recipient_phone' => fake()->phoneNumber(),
                    'items_type' => fake()->randomElement($itemsTypes),
                ]);

                $fromLocation = $shipment->locations()->create([
                    'country_id' => 185,
                    'state_id' => $state->id,
                    'address' => Str::of(fake()->address())->replace('\n', ', ')->toString(),
                    'latitude' => fake()->latitude(18.88, 28.98),
                    'longitude' => fake()->longitude(40.07, 49.17),
                ]);

                $toLocation = $shipment->locations()->create([
                    'country_id' => 185,
                    'state_id' => $state->id,
                    'address' => Str::of(fake()->address())->replace('\n', ', ')->toString(),
                    'latitude' => fake()->latitude($fromLocation->latitude, $fromLocation->latitude + 0.1),
                    'longitude' => fake()->longitude($fromLocation->longitude, $fromLocation->longitude + 0.1),
                ]);
                $shipment->from_location_id = $fromLocation->id;
                $shipment->to_location_id = $toLocation->id;

                $minBudget = $shipment->prices()->create([
                    'value' => rand(10, 100),
                    'currency_id' => 117,
                ]);

                $maxBudget = $shipment->prices()->create([
                    'value' => rand($minBudget->value, $minBudget->value * 2),
                    'currency_id' => 117,
                ]);

                $shipment->min_budget_id = $minBudget->id;
                $shipment->max_budget_id = $maxBudget->id;
                $shipment->save();

                if ($shipment->items_type == 'box' || $shipment->items_type == 'document') {
                    $shipment->items()->create([
                        'notes' => fake()->paragraph(6),
                        'cap_weight' => rand(1, 10),
                        'cap_unit' => 'kg',
                        'dim_length' => rand(1, 10),
                        'dim_width' => rand(1, 10),
                        'dim_height' => rand(1, 10),
                        'content' => fake()->sentence(),
                        'content_value' => rand(10, 100),
                    ]);
                } else {
                    for ($j = 0; $j < rand(2, 5); $j++) {
                        $shipment->items()->create([
                            'notes' => fake()->paragraph(2),
                            'cap_weight' => rand(1, 10),
                            'cap_unit' => 'kg',
                            'dim_length' => rand(1, 10),
                            'dim_width' => rand(1, 10),
                            'dim_height' => rand(1, 10),
                            'content' => fake()->sentence(),
                            'content_value' => rand(10, 100),
                        ]);
                    }
                }

                $shipmentHelper = new ShipmentHelper($shipment);
                $shipmentHelper->setAuthUser($user)
                    ->confirmShipment();

                // create random invitations
                for ($j = 0; $j < rand(3, 6); $j++) {
                    $driver = User::query()->inRandomOrder()->first();
                    $invStatus = fake()->randomElement([
                        'pending',
                        'accepted',
                        'declined',
                    ]);

                    $inv = $shipment->invitations()->create([
                        'driver_id' => $driver->id,
                    ]);

                    if ($invStatus == 'accepted') {
                        $shipmentHelper->setAuthUser($driver)
                            ->acceptInvitation($inv);
                        $this->createProposalFromInvitation($inv, $shipmentHelper);
                    }
                    if ($invStatus == 'declined') {
                        $shipmentHelper->setAuthUser($driver)
                            ->declineInvitation($inv);
                    }
                }
                for ($j = 0; $j < rand(2, 5); $j++) {
                    $company = Company::query()->inRandomOrder()->first();
                    $companyMember = $company->members()->inRandomOrder()->first()->user;
                    $invStatus = fake()->randomElement([
                        'pending',
                        'accepted',
                        'declined',
                    ]);
                    $inv = $shipment->invitations()->create([
                        'company_id' => $company->id,
                    ]);
                    if ($invStatus == 'accepted') {
                        $shipmentHelper->setAuthUser($companyMember)
                            ->acceptInvitation($inv);
                        $this->createProposalFromInvitation($inv, $shipmentHelper);
                    }
                    if ($invStatus == 'declined') {
                        $shipmentHelper->setAuthUser($companyMember)
                            ->declineInvitation($inv);
                    }
                }
            }
        }
    }

    public function createProposalFromInvitation(ShipmentInvitation $shipmentInvitation, ShipmentHelper $shipmentHelper)
    {
        $status = fake()->randomElement([
            'pending',
            'accepted',
            'declined',
        ]);
        $proposal = $shipmentInvitation->proposal()->create([
            ...$shipmentInvitation->toArray(),
            'message' => fake()->sentence(),
        ]);

        $cost = $proposal->prices()->create([
            'value' => rand(50, 400),
            'currency_id' => 117,
        ]);

        $fee = $proposal->prices()->create([
            'value' => rand(5, 50),
            'currency_id' => 117,
        ]);

        $proposal->cost_id = $cost->id;
        $proposal->fee_id = $fee->id;
        $proposal->save();

        $shipmentHelper
            ->setActiveInvitation($shipmentInvitation)
            ->handleNewProposal($proposal);

        if (fake()->boolean()) {
            if ($status == 'accepted') {
                $shipmentHelper->setAuthUser($proposal->shipment->user)
                    ->acceptProposal($proposal);
            }

            if ($status == 'declined') {
                $shipmentHelper->setAuthUser($proposal->shipment->user)
                    ->declineProposal($proposal);
            }
        }
    }

    public function addAvatarsToAllUsers()
    {
        foreach (User::all() as $user) {
            if (fake()->boolean()) {
                $this->addMedia($user, 'https://i.pravatar.cc/150?u=' . $user->email, 'avatar');
            }
        }
    }

    public function createChat()
    {
        $channel = ChatChannel::create([
            'name' => 'General Sawaeed Chat',
            'creator_id' => User::query()->inRandomOrder()->first()->id,
        ]);

        $users = User::query()->limit(5)->get();
        foreach ($users as $user) {
            $channel->members()->create([
                'user_id' => $user->id,
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            $user = fake()->randomElement($users);
            $message = $channel->messages()->create([
                'user_id' => $user->id,
                'text' => fake()->sentence(),
            ]);
            $message->created_at = now()->subMinutes($i);
            $message->save();
        }
    }

    // add image
    public function addMedia(Model $model, string $url, string $collection = 'default')
    {
        $media = $model->addMediaFromUrl($url)
            ->toMediaCollection($collection);

        return $media;
    }

    public function createCompanyOwners()
    {
        for ($i = 1; $i <= 2; $i++) {
            // create fake driver
            $user = User::factory()->create();
            $user->assignRole('company_owner');

            $this->createCompany($user, $i);
        }
    }

    public function createCompanyFakeInvitations(Company $company)
    {
        for ($j = 1; $j < rand(2, 3); $j++) {
            $company->invitations()->create([
                'name' => fake()->name(),
                'phone_number' => fake()->phoneNumber(),
                'email' => fake()->email(),
                'invitation_code' => fake()->uuid(),
                'role' => 'company_driver',
                'is_rejected' => fake()->boolean(),
            ]);
        }

        for ($j = 1; $j < rand(2, 3); $j++) {
            $company->invitations()->create([
                'name' => fake()->name(),
                'phone_number' => fake()->phoneNumber(),
                'email' => fake()->email(),
                'invitation_code' => fake()->uuid(),
                'role' => 'company_manager',
                'is_rejected' => fake()->boolean(),
            ]);
        }
    }

    public function createSoloDrivers()
    {
        for ($i = 0; $i < rand(10, 15); $i++) {
            // create fake driver
            $driver = User::factory()->create();
            $driver->assignRole('solo_driver');

            $this->createEntityRating($driver);
            $this->createEntityVehicle($driver);
        }
    }

    public function createCompany(User $user, int $index)
    {
        $roles = ['company_driver', 'company_manager'];

        $companyInfoJsonUrl = "https://zix-images.zixdev.com/images/companies/transportation/$index/info.json";
        $companyInfo = json_decode(file_get_contents($companyInfoJsonUrl), true);

        // create fake company
        $company = Company::create([
            'name' => $companyInfo['name'],
            'about' => $companyInfo['description'],
        ]);

        $company->owner_id = $user->id;
        $company->verification_status = Company::VERIFICATION_STATUS_VERIFIED;
        $company->is_verified = true;
        $company->verified_by = User::first()->id;
        $company->verified_at = now();

        $company->save();

        $company->members()->create([
            'user_id' => $user->id,
            'role' => 'company_owner',
        ]);

        $this->addMedia($company, "https://zix-images.zixdev.com/images/companies/transportation/$index/logo.png", 'logo');

        $company->location_id  = $company->locations()->create([
            'country_id' => 185,
            'address' => fake()->address(),
            'latitude' => fake()->latitude(24.5, 24.9),
            'longitude' => fake()->longitude(46.6, 46.97),
        ])->id;
        $company->save();


        // add managers, should be new users
        for ($i = 0; $i < rand(2, 5); $i++) {
            $selectedRole = fake()->randomElement($roles);
            $manager = User::factory()->create();
            $manager->assignRole($selectedRole);
            $company->members()->create([
                'user_id' => $manager->id,
                'role' => $selectedRole,
            ]);
        }
        User::query()
            ->whereHas('roles', static function ($query): void {
                $query->where('name', 'solo_driver');
            })
            ->inRandomOrder()
            ->limit(rand(3, 6))->get()->map(function ($user) use ($company, $roles) {
                $selectedRole = fake()->randomElement($roles);
                $company->members()->create([
                    'user_id' => $user->id,
                    'role' => 'company_driver',
                ]);
                $user->assignRole('company_driver');
            });

        for ($j = 0; $j < 3; $j++) {
            $company->invitations()->create([
                'name' => fake()->name(),
                'phone_number' => fake()->phoneNumber(),
                'email' => fake()->email(),
                'invitation_code' => fake()->uuid(),
                'role' => fake()->randomElement($roles),
            ]);
        }

        $this->createEntityRating($company);

        for ($j = 0; $j < rand(2, 5); $j++) {
            $this->createEntityVehicle($company);
        }
    }

    public function createEntityRating(User|Company $entity)
    {
        User::query()->inRandomOrder()->limit(rand(2, 4))->get()->map(function ($user) use ($entity) {
            $rating = $entity->ratings()->create([
                'user_id' => $user->id,
                'comment' => fake()->sentence(),
            ]);

            RatingType::query()->inRandomOrder()->get()->map(function ($ratingType) use ($rating) {
                $rating->scores()->create([
                    'rating_type_id' => $ratingType->id,
                    'score' => rand(1, 5),
                ]);
            });
        });
    }

    public function createEntityVehicle(User|Company $entity)
    {
        $modelType = VehicleModel::query()->inRandomOrder()->first();
        $vehicle = $entity->vehicles()->create([
            'plate_number' => fake()->regexify('[A-Z]{3}-[0-9]{3}'),
            'vin_number' => fake()->regexify('[A-Z0-9]{17}'),
            'year' => fake()->year(),
            'color' => fake()->colorName(),
            'model_id' => $modelType->id,
        ]);

        $vehicle->information()->create([
            'body_type' => fake()->randomElement(['sedan', 'suv', 'truck', 'van', 'coupe', 'convertible', 'hatchback', 'wagon', 'crossover', 'other']),
            'steering_wheel' => fake()->randomElement(['left', 'right']),
            'doors_count' => fake()->randomElement([2, 4, 5]),
            'seats_count' => fake()->randomElement([2, 4, 5, 7, 8, 9]),
            'top_speed' => fake()->randomElement([60, 80, 120, 140, 160, 180, 200]),
        ]);

        $vehicle->fuelInformation()->create([
            'fuel_type' => fake()->randomElement(['gasoline', 'diesel', 'electric', 'hybrid']),
            'fuel_capacity' => fake()->randomElement([40, 50, 60, 70, 80, 90, 100]),
            'liter_per_km_in_city' => fake()->randomElement([5, 6, 7, 8, 9, 10]),
            'liter_per_km_in_highway' => fake()->randomElement([4, 5, 6, 7, 8, 9]),
            'liter_per_km_mixed' => fake()->randomElement([4, 5, 6, 7, 8, 9]),
        ]);

        $vehicle->capacityDimensions()->create([
            'width' => rand(50, 500),
            'height' => rand(50, 150),
            'length' => rand(100, 500),
            'unit' => fake()->randomElement(['cm', 'm']),
        ]);

        $vehicle->capacityWeight()->create([
            'value' => rand(500, 5000),
            'unit' => 'kg',
        ]);

        $index = $modelType->order;

        $vehicle->addMediaFromUrl("https://zix-images.zixdev.com/images/vehicles/$index/image.png")
            ->toMediaCollection('image');

        for ($i = 0; $i < rand(2, 4); $i++) {
            $vehicle->addMediaFromUrl("https://zix-images.zixdev.com/images/vehicles/$index/image.png")
                ->toMediaCollection('images');
        }
    }
}
