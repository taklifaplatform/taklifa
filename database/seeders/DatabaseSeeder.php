<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ShieldSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(\Modules\Product\Database\Seeders\ProductCategorySeeder::class);
        if (app()->isLocal()) {
            $this->call(FakeSeeder::class);
        }
    }
}
