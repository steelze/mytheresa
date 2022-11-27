<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected int $order = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->order++;

        return [
            'sku' => str_pad($this->order, 6, "0", STR_PAD_LEFT),
            'name' => 'BV Lean leather ankle boots',
            'category' => 'boots',
            'price' => $this->faker->numberBetween(10000, 500000),
        ];
    }
}
