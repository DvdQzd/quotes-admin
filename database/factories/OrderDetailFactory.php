<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'width' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            'height' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'product_id' => $this->faker->numberBetween($min = 1, $max = 5)
        ];
    }
}
