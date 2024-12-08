<?php

namespace Database\Factories;

use App\Models\Brands;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products;

class ProductFactory extends Factory
{

    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $brand = Brands::inRandomOrder()->first(); // Обратите внимание на исправление названия модели
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'category_id' => $category ? $category->id : null,
            'brand_id' => $brand ? $brand->id : null,
        ];
    }
}