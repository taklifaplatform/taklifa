<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Modules\Geography\Entities\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/login', function () {
    return redirect('/admin');
})->name('login');

Route::get('/test', function () {
    $locationsQuery = Location::query()
        ->whereBetween('latitude', [
            24.693830243423697 - 0.08871718133676154,
            24.693830243423697 + 0.08871718133676154
        ])
        ->whereBetween('longitude', [
            46.66665970830967 -  0.01069134249615189,
            46.66665970830967 +  0.01069134249615189
        ]);
    $locations = $locationsQuery->get();
    return $locations;
});

// Route::get('/fix', function () {
//     $drivers = User::query()
//         ->whereHas('roles', static function ($query): void {
//             $query->whereIn('name', [
//                 User::ROLE_SOLO_DRIVER,
//                 User::ROLE_COMPANY_DRIVER,
//             ]);
//         })->get();
//     foreach ($drivers as $driver) {
//         foreach ($driver->locations as $location) {
//             $location->update([
//                 'country_id' => 185,
//                 'address' => fake()->address(),
//                 'latitude' => fake()->latitude(24.5, 24.9),
//                 'longitude' => fake()->longitude(46.6, 46.97),
//             ]);
//         }
//     }

//     return $drivers;
// });



$applinks = [
    "applinks" => [
        "apps" => [],
        "details" => [
            [
                "appID" =>  "DZPLAPPP9Y.app.taklifa",
                "paths" =>  [
                    "*"
                ]
            ],
        ]
    ]
];
Route::get('apple-app-site-association', function () use ($applinks) {
    return response()->json($applinks);
});
Route::get('.well-known/apple-app-site-association', function () use ($applinks) {
    return response()->json($applinks);
});


Route::get('make-all-media-public', function () {
    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::all();
    $s3 = \Storage::disk('s3');

    foreach ($media as $item) {
        try {
            $s3->setVisibility($item->getPath(), 'public');
        } catch (\Exception $e) {
            \Log::error("Failed to update visibility for media ID {$item->id}: " . $e->getMessage());
        }
        // dd($item, $item->getUrl());
    }

    return response()->json(['message' => 'S3 objects visibility update completed']);
});


// Route::get('seee-cats-data', function () {
//     $subCategories = [
//         [
//             'name' => [
//                 'ar' => 'تويوتا',
//                 'en' => 'Toyota'
//             ],
//             'enabled' => true,
//             'order' => 1,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'فورد',
//                 'en' => 'Ford'
//             ],
//             'enabled' => true,
//             'order' => 2,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'شيفروليه',
//                 'en' => 'Chevrolet'
//             ],
//             'enabled' => true,
//             'order' => 3,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'نيسان',
//                 'en' => 'Nissan'
//             ],
//             'enabled' => true,
//             'order' => 4,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'هيونداي',
//                 'en' => 'Hyundai'
//             ],
//             'enabled' => true,
//             'order' => 5,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'لكزس',
//                 'en' => 'Lexus'
//             ],
//             'enabled' => true,
//             'order' => 6,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'جي ام سي',
//                 'en' => 'GMC'
//             ],
//             'enabled' => true,
//             'order' => 7,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'كاديلاك',
//                 'en' => 'Cadillac'
//             ],
//             'enabled' => true,
//             'order' => 8,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'همر',
//                 'en' => 'Hummer'
//             ],
//             'enabled' => true,
//             'order' => 9,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'لنكولن',
//                 'en' => 'Lincoln'
//             ],
//             'enabled' => true,
//             'order' => 10,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ]
//     ];
//     $categories = [
//         [
//             'name' => [
//                 'ar' => 'سيارات مصدومه للبيع',
//                 'en' => 'Damaged Cars for Sale'
//             ],
//             'enabled' => true,
//             'order' => 1,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سيارات عطلانه للبيع',
//                 'en' => 'Non-Working Cars for Sale'
//             ],
//             'enabled' => true,
//             'order' => 2,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سيارات تشليح للبيع',
//                 'en' => 'Salvage Cars for Sale'
//             ],
//             'enabled' => true,
//             'order' => 3,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'مكاين سيارات للبيع',
//                 'en' => 'Car Engines for Sale'
//             ],
//             'enabled' => true,
//             'order' => 4,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'قيور سيارات للبيع',
//                 'en' => 'Car Gearboxes for Sale'
//             ],
//             'enabled' => true,
//             'order' => 5,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سطحات للبيع',
//                 'en' => 'Flatbed Trucks for Sale'
//             ],
//             'enabled' => true,
//             'order' => 6,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'دينات للبيع',
//                 'en' => 'Dyna Trucks for Sale'
//             ],
//             'enabled' => true,
//             'order' => 7,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'تيدر ولوبد للبيع',
//                 'en' => 'Tidr and Lowbed for Sale'
//             ],
//             'enabled' => true,
//             'order' => 8,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'معدات ثقيلة للبيع',
//                 'en' => 'Heavy Equipment for Sale'
//             ],
//             'enabled' => true,
//             'order' => 9,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'قطع غيار للبيع',
//                 'en' => 'Spare Parts for Sale'
//             ],
//             'enabled' => true,
//             'order' => 10,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'راس تريله للبيع',
//                 'en' => 'Truck Heads for Sale'
//             ],
//             'enabled' => true,
//             'order' => 11,
//             'parent_id' => null,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ]
//     ];

//     foreach ($categories as $category) {
//         $category = \Modules\Services\Entities\ServiceCategory::create($category);
//         foreach ($subCategories as $subCategory) {
//             $subCategory['parent_id'] = $category->id;
//             \Modules\Services\Entities\ServiceCategory::create($subCategory);
//         }
//     }
// });


// Route::get('seee-cats-data', function () {
//     $subCategories = [
//         [
//             'name' => [
//                 'ar' => 'مرسيد',
//                 'en' => 'Mercedes'
//             ],
//             'enabled' => true,
//             'order' => 11,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'هوندا',
//                 'en' => 'Honda'
//             ],
//             'enabled' => true,
//             'order' => 12,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'بي ام دبليو',
//                 'en' => 'BMW'
//             ],
//             'enabled' => true,
//             'order' => 13,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'كيا',
//                 'en' => 'Kia'
//             ],
//             'enabled' => true,
//             'order' => 14,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'دوج',
//                 'en' => 'Dodge'
//             ],
//             'enabled' => true,
//             'order' => 15,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'كرايزلر',
//                 'en' => 'Chrysler'
//             ],
//             'enabled' => true,
//             'order' => 16,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'جيب',
//                 'en' => 'Jeep'
//             ],
//             'enabled' => true,
//             'order' => 17,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'ميتسوبيشي',
//                 'en' => 'Mitsubishi'
//             ],
//             'enabled' => true,
//             'order' => 18,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'مازدا',
//                 'en' => 'Mazda'
//             ],
//             'enabled' => true,
//             'order' => 19,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'لاند روفر',
//                 'en' => 'Land Rover'
//             ],
//             'enabled' => true,
//             'order' => 20,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'ايسوزو',
//                 'en' => 'Isuzu'
//             ],
//             'enabled' => true,
//             'order' => 21,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'بورش',
//                 'en' => 'Porsche'
//             ],
//             'enabled' => true,
//             'order' => 22,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'اودي',
//                 'en' => 'Audi'
//             ],
//             'enabled' => true,
//             'order' => 23,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سوزوكي',
//                 'en' => 'Suzuki'
//             ],
//             'enabled' => true,
//             'order' => 24,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'انفنتي',
//                 'en' => 'Infiniti'
//             ],
//             'enabled' => true,
//             'order' => 25,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'فلكس واجن',
//                 'en' => 'Volkswagen'
//             ],
//             'enabled' => true,
//             'order' => 26,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'جيلي',
//                 'en' => 'Geely'
//             ],
//             'enabled' => true,
//             'order' => 27,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'بيجو',
//                 'en' => 'Peugeot'
//             ],
//             'enabled' => true,
//             'order' => 28,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'بنتلي',
//                 'en' => 'Bentley'
//             ],
//             'enabled' => true,
//             'order' => 29,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'جاكوار',
//                 'en' => 'Jaguar'
//             ],
//             'enabled' => true,
//             'order' => 30,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سوبارو',
//                 'en' => 'Subaru'
//             ],
//             'enabled' => true,
//             'order' => 31,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'شانجان',
//                 'en' => 'Changan'
//             ],
//             'enabled' => true,
//             'order' => 32,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'رينو',
//                 'en' => 'Renault'
//             ],
//             'enabled' => true,
//             'order' => 33,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'مازيراتي',
//                 'en' => 'Maserati'
//             ],
//             'enabled' => true,
//             'order' => 34,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'رولز رويس',
//                 'en' => 'Rolls Royce'
//             ],
//             'enabled' => true,
//             'order' => 35,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'لامبرجيني',
//                 'en' => 'Lamborghini'
//             ],
//             'enabled' => true,
//             'order' => 36,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'سكودا',
//                 'en' => 'Skoda'
//             ],
//             'enabled' => true,
//             'order' => 37,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'فيراري',
//                 'en' => 'Ferrari'
//             ],
//             'enabled' => true,
//             'order' => 38,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'شيري',
//                 'en' => 'Chery'
//             ],
//             'enabled' => true,
//             'order' => 39,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'استون مارتن',
//                 'en' => 'Aston Martin'
//             ],
//             'enabled' => true,
//             'order' => 40,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'هافال',
//                 'en' => 'Haval'
//             ],
//             'enabled' => true,
//             'order' => 41,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'جريت وول',
//                 'en' => 'Great Wall'
//             ],
//             'enabled' => true,
//             'order' => 42,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ],
//         [
//             'name' => [
//                 'ar' => 'اخرى',
//                 'en' => 'Other'
//             ],
//             'enabled' => true,
//             'order' => 43,
//             'metadata_fields' => [
//                 [
//                     'identifier' => 'model_year',
//                     'name_en' => 'Model Year',
//                     'name_ar' => 'سنة الموديل',
//                     'type' => 'number',
//                     'placeholder_en' => 'Model Year',
//                     'placeholder_ar' => 'سنة الموديل',
//                 ]
//             ]
//         ]
//     ];

//     foreach(\Modules\Services\Entities\ServiceCategory::where('parent_id', null)->get() as $category) {
//         foreach($subCategories as $subCategory) {
//             $count = \Modules\Services\Entities\ServiceCategory::where('parent_id', $category->id)->count();
//             $subCategory['order'] = $count + 1;
//             \Modules\Services\Entities\ServiceCategory::create([
//                 'parent_id' => $category->id,
//                 ...$subCategory,
//             ]);
//         }
//     }
// });


Route::get('fix-companies-without-owner', function () {
    try {
        $companies = \Modules\Company\Entities\Company::whereNull('owner_id')->get();
        // $companies = \Modules\Company\Entities\Company::all();

        foreach ($companies as $company) {
            $member = $company->members()->first();
            if (!$member) {
                continue;
            }
            $company->owner_id = $member->user_id;
            $company->save();
        }
    } catch (\Throwable $th) {
        dd($th);
    }
});
