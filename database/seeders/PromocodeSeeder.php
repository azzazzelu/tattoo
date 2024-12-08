<?php

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PromocodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $image_url = $faker->imageUrl(300, 300, 'cats');

        $codes = [
            ['name' => 'Пакет “Лето”', 'code' => 'MR. Driskell', 'img' => $image_url, 'description' => "Самое жаркое лето века не хочет уходить и давит Вам новые краски до конца сезона.
При покупке от 5500₽ Вы получите скидку 1% на абсолютно любой товар! Успей окрасить свою жизнь касками лета!", 'short_description' => null, 'is_active' => true, 'discount_amount' => 10.00],
            ['name' => 'Промокод TATY', 'code' => 'TATY', 'img' => $image_url, 'description' => "Специально для четких и дерзких есть супервыгодное предложение, при покупке двух тату-наборов и двух пачек игл, Вы получите целых 5% скидки на воопложение своей мечты.", 'short_description' => null, 'is_active' => true, 'discount_amount' => 15.00],
            ['name' => 'Промокод azazin', 'code' => 'azazin', 'img' => $image_url, 'description' => "Дикое и приятное колючее предложение, при покупке любых 5 игл и 5 типсов, Вы получите скидку 2% !", 'short_description' => null, 'is_active' => true, 'discount_amount' => 40.00],
        ];

        foreach ($codes as $code) {
            Promocode::create($code);
        }
    }
}
