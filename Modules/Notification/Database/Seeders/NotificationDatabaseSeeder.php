<?php

namespace Modules\Notification\Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NotificationTemplateSeeder::class);
    }
}
