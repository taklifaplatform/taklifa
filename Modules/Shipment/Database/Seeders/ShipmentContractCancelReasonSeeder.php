<?php

namespace Modules\Shipment\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ShipmentContractCancelReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $reasons = [
            [
                'title' => [
                    'en' => 'Driver is not responding',
                    'ar' => 'السائق لا يستجيب',
                ],
                'for_customer' => true,
            ],
            [
                'title' => [
                    'en' => 'Driver is late',
                    'ar' => 'السائق متأخر',
                ],
                'for_customer' => true,
            ],
            // for driver
            [
                'title' => [
                    'en' => 'Customer is not responding',
                    'ar' => 'العميل لا يستجيب',
                ],
                'for_customer' => false,
            ],
            [
                'title' => [
                    'en' => 'Customer is late',
                    'ar' => 'العميل متأخر',
                ],
                'for_customer' => false,
            ],
            [
                'title' => [
                    'en' => 'Customer is not available',
                    'ar' => 'العميل غير متوفر',
                ],
                'for_customer' => false,
            ],
            [
                'title' => [
                    'en' => 'Customer is not at the location',
                    'ar' => 'العميل ليس في الموقع',
                ],
                'for_customer' => false,
            ],

        ];

        foreach ($reasons as $reason) {
            \Modules\Shipment\Entities\ShipmentContractCancelReason::create($reason);
        }

        // $this->call("OthersTableSeeder");
    }
}
