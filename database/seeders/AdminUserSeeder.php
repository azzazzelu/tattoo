<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'admin' => '1',
            'email' => 'admin@gmail.com', // укажите нужный email
            'password' => Hash::make('123'), // укажите нужный пароль
        ]);
    }
}
