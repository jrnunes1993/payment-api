<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = StringHelper::random(['Paid', 'Pending', 'Canceled']);
        $paidAt = ($status == 'Paid' ? date_format($this->faker->dateTimeBetween('- 1 week', 'now'), "Y/m/d") : null);

        return [
            'value' => random_int(2000, 50000) / 100, // values between 20,00 and 500,00
            'status' => $status,
            'referenceId' => $this->faker->uuid(),
            'type' => StringHelper::random(['creditCard', 'debitCard', 'bankSlip']),
            'dueDate' => date_format($this->faker->dateTimeBetween('1 week', '1 year'), "Y/m/d"),
            'paidedAt' => $paidAt,
            'studentId' => Student::all()->random()->id
        ];
    }
}
