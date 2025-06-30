<?php

namespace Modules\Geography\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeographyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $data = [
            'countries',
            'states',
            'cities',
            'currencies',
            'diallings',
            'taxes',
        ];

        foreach ($data as $table) {
            $sql = module_path('Geography', 'Database/Seeders/mysql/'.$table.'.sql');
            DB::unprepared(file_get_contents($sql));
        }
    }
}
