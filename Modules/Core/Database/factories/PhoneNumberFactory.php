<?php

namespace Modules\Core\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneNumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Core\Entities\PhoneNumber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => fake()->phoneNumber(),
            'is_primary' => fake()->boolean(),
            'type' => fake()->randomElement(['mobile', 'fax', 'other']),
        ];
    }
}
