<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Company\Entities\Company;
use Modules\Rating\Entities\RatingType;

class FakeSeederOld extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->createSoloDrivers();

        // $this->createCompanies();
    }

    public function createSoloDrivers()
    {
        for ($i = 0; $i < rand(10, 15); $i++) {
            // create fake driver
            $driver = User::factory()->create();
            $driver->assignRole('solo_driver');

            $this->createEntityRating($driver);
        }
    }

    public function createCompanies()
    {
        for ($i = 0; $i < 3; $i++) {
            // create fake company
            $company = Company::create([
                'name' => fake()->company(),
            ]);

            $company->owner_id = 1;
            $company->save();

            // create fake drivers
            User::factory()->count(rand(3, 10))->create()->map(function ($user) use ($company) {
                $company->drivers()->attach($user->id);
                $user->assignRole('company_driver');
            });

            // create fake managers
            User::factory()->count(rand(3, 10))->create()->map(function ($user) use ($company) {
                $company->managers()->attach($user->id);
                $user->assignRole('company_manager');
            });

            // create fake drivers invitations
            for ($j = 0; $j < 3; $j++) {
                $company->driverInvitations()->create([
                    'name' => fake()->name(),
                    'phone_number' => fake()->phoneNumber(),
                    'email' => fake()->email(),
                    'invitation_code' => fake()->uuid(),
                ]);
            }

            // create fake managers invitations
            for ($j = 0; $j < 3; $j++) {
                $company->managerInvitations()->create([
                    'name' => fake()->name(),
                    'phone_number' => fake()->phoneNumber(),
                    'email' => fake()->email(),
                    'invitation_code' => fake()->uuid(),
                ]);
            }

            $this->createEntityRating($company);
        }
    }

    public function createEntityRating(User|Company $entity)
    {
        User::query()->inRandomOrder()->limit(rand(5, 10))->get()->map(function ($user) use ($entity) {
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
