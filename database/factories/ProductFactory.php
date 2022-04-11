<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'Description' => $this->faker->paragraph(),
            'price' => $this->faker->randomDigit(),
            //'image' => $this->faker->imageUrl($width = 200, $height = 200),
            'category_id' => Category::count() ? Category::pluck('id')->random() : 1,
            'is_active' => 1,
        ];
    }
}
