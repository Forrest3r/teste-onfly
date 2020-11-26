<?php

namespace Database\Factories;

use App\Models\Despesa;
use Illuminate\Database\Eloquent\Factories\Factory;

class DespesaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Despesa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(25),
            'date' => $this->faker->date($format = 'Y-m-d', $min = 'now', $max = 'now'),
            'value' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 15000),
            'receipt' => 'receipts/standard.jpg',           
        ];
    }
}
