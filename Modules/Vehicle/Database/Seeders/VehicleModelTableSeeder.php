<?php

namespace Modules\Vehicle\Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            [
                'name' => [
                    'en' => 'Atego Truck',
                    'ar' => 'شاحنة Atego',
                ],
                'map_icon_width' => '$5',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'Truck with large tank trailer',
                    'ar' => 'شاحنة بمقطورة كبيرة',
                ],
                'map_icon_width' => '$8',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'Truck with tank trailer',
                    'ar' => 'شاحنة بمقطورة صهريج',
                ],
                'map_icon_width' => '$8',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'Transportation Collection',
                    'ar' => 'مجموعة النقل',
                ],
                'map_icon_width' => '$8',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'E',
                    'ar' => 'E',
                ],
                'map_icon_width' => '$6',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'F',
                    'ar' => 'F',
                ],
                'map_icon_width' => '$7',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'G',
                    'ar' => 'G',
                ],
                'map_icon_width' => '$4',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'H',
                    'ar' => 'H',
                ],
                'map_icon_width' => '$4',
                'map_icon_height' => '$4',
            ],
            [
                'name' => [
                    'en' => 'PP',
                    'ar' => 'PP',
                ],
                'map_icon_width' => '$8',
                'map_icon_height' => '$4',
            ],
        ];

        $index = 1;
        foreach ($models as $model) {
            $type = \Modules\Vehicle\Entities\VehicleModel::create([
                'name' => $model['name'],
                'map_icon_width' => $model['map_icon_width'],
                'map_icon_height' => $model['map_icon_height'],
                'order' => $index,
            ]);

            $type->addMediaFromUrl("https://zix-images.zixdev.com/images/vehicles/$index/image.png")
                ->toMediaCollection('map_icon');

            $index++;
        }
    }
}
