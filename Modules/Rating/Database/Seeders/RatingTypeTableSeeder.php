<?php

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Seeder;

class RatingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingTypes = [
            [
                'name' => 'Cleanliness',
            ],
            [
                'name' => 'Punctuality',
            ],
            [
                'name' => 'Safety',
            ],
            [
                'name' => 'Comfort',
            ],
            [
                'name' => 'Driver',
            ],
            [
                'name' => 'Overall',
            ],
        ];

        foreach ($ratingTypes as $ratingType) {
            \Modules\Rating\Entities\RatingType::create($ratingType);
        }
    }
}
