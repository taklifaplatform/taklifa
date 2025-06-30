<?php

namespace Modules\Core\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Core\Entities\EmailAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => fake()->email(),
            'is_primary' => fake()->boolean(),
            'type' => fake()->randomElement(['personal', 'work', 'other']),
        ];
    }
}
