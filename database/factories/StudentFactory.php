<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => StringHelper::random(['Registered', 'Locked', 'Canceled']),
            'document' => $this->faker->unique()->numerify('###########'),
            'phoneNumber' => $this->faker->unique()->phoneNumber(),
            'country' => $this->faker->unique()->country(),
            'city' => $this->faker->unique()->city(),
            'street' => $this->faker->unique()->streetName(),
            'number' => random_int(1, 9999),
            'locality' => 'Rio Grande do Sul',
            'state' => 'RS',
            'postalCode' => $this->faker->unique()->postcode(),
        ];
    }
}
