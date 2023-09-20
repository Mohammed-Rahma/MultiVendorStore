<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->productName;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(15),
            'image' => fake()->imageUrl,
            'price' => fake()->randomFloat(1, 1, 499),
            'compare_price' => fake()->randomFloat(1, 500, 999),
            'category_id' => Category::inRandomOrder()->first()->id,
            'featured' => rand(0, 1),
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
