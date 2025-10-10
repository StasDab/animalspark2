<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем администратора
        User::create([
            'name' => 'Администратор',
            'email' => 'admin@zoo.com',
            'password' => Hash::make('password'),
        ]);

        // Создаем тестового пользователя
        User::create([
            'name' => 'Тестовый пользователь',
            'email' => 'user@zoo.com',
            'password' => Hash::make('password'),
        ]);
    }
}
