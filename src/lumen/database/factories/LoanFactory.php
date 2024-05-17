<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'borrower_name' => $this->faker->name,
            'amount' => (string)$this->faker->randomFloat(2, 100, 10000),
            'loan_date' => $this->faker->date,
        ];
    }
}
