<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'category_name' => 'Grocery',
            'is_active' => '1'
        ]);

        Category::create([
            'category_name' => 'Electronics',
            'is_active' => '1'
        ]);

        Category::create([
            'category_name' => 'Accessories',
            'is_active' => '1'
        ]);

        Category::factory()->count(10)->create();
    }
}
