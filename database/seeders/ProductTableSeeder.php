<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ProductFactory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $product = [
            'Foxxx Kitsune Mini Black Vintage RCA',
        ];
        // Используем фабрику для создания записей
        
        ProductFactory::factory()->count(10)->create();
    }
}
