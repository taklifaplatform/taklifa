<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\Rating\Entities\RatingType;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsers();
        $this->createCompanies();
    }

    public function createUsers()
    {
        User::factory()->count(10)->create();
    }

    public function createCompanies()
    {
        for ($i = 0; $i < 20; $i++) {
            $owner = User::inRandomOrder()->first();

            $company = Company::create([
                'name' => fake()->company(),
                'owner_id' => $owner->id,
            ]);

            $address = fake()->address();
            // remove any break lines
            $address = Str::of($address)->replace('\n', ', ')->toString();
            $company->location_id = $company->locations()->create([
                'country_id' => 185,
                'address' => $address,
                'latitude' => fake()->latitude(24.5, 24.9),
                'longitude' => fake()->longitude(46.6, 46.97),
            ])->id;

            $company->is_verified = true;
            $company->save();

            $this->createProducts($company);
        }
    }

    public function createProducts($company)
    {
        $types = [
            'count',
            'weight',
            'size',
        ];

        $typeUnits = [
            'weight' => [
                'g',
                'kg',
                'lb',
                'oz',
            ],
            'size' => [
                'cm',
                'm',
                'in',
                'ft',
            ],
        ];

        $constructionProducts = [
            "أسمنت بورتلاندي",
            "حديد تسليح",
            "بلوك أسمنتي",
            "طابوق عازل",
            "رمل مغسول",
            "حصى خرسانة",
            "خرسانة جاهزة",
            "قواعد خرسانية",
            "أعمدة حديدية",
            "ألواح جبسية",
            "دهانات خارجية",
            "عازل حراري",
            "عازل مائي",
            "بلاط أرضيات",
            "سيراميك جدران",
            "رخام طبيعي",
            "جرانيت سعودي",
            "قرميد أسطح",
            "أبواب حديد",
            "أبواب خشب",
            "نوافذ ألمنيوم",
            "شبك حديد",
            "أسقف مستعارة",
            "مواسير سباكة",
            "وصلات كهرباء",
            "كابلات ضغط عالي",
            "مصابيح إنارة",
            "سقالات حديدية",
            "معدات حفر",
            "معدات رفع ثقيلة"
        ];
        for ($i = 0; $i < 10; $i++) {
            $productName = fake()->randomElement($constructionProducts);
            $product = Product::create([
                'name' => $productName,
                'company_id' => $company->id,
            ]);


            $type = fake()->randomElement($types);
            $typeUnit = $type == 'count' ? null : fake()->randomElement($typeUnits[$type]);
            $typeValue = $type == 'count' ? null : fake()->randomFloat(2, 1, 1000);
            $product->variant()->create([
                'price' => fake()->randomFloat(2, 1, 1000),
                'price_currency' => 'SAR',
                'type' => $type,
                'type_unit' => $typeUnit,
                'type_value' => $typeValue,
                'stock' => fake()->numberBetween(1, 1000),
            ]);
        }
    }
}
