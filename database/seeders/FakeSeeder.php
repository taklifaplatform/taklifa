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

        $this->addAvatarsToAllUsers();

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

    public function addAvatarsToAllUsers()
    {
        foreach (User::all() as $user) {
            if (fake()->boolean()) {
                $this->addMedia($user, 'https://i.pravatar.cc/150?u=' . $user->email, 'avatar');
            }
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
}
