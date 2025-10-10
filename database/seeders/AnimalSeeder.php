<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\Cage;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cages = Cage::all();
        
        if ($cages->count() == 0) {
            $this->command->info('Сначала создайте клетки! Запустите CageSeeder.');
            return;
        }

        $animals = [
            [
                'species' => 'Лев',
                'name' => 'Симба',
                'age' => 5,
                'description' => 'Величественный самец льва с золотистой гривой. Очень дружелюбный и любит играть с посетителями.',
                'cage_id' => $cages->where('name', 'Большая клетка для хищников')->first()->id
            ],
            [
                'species' => 'Тигр',
                'name' => 'Амур',
                'age' => 7,
                'description' => 'Красивый амурский тигр с полосатой шерстью. Спокойный и уравновешенный характер.',
                'cage_id' => $cages->where('name', 'Большая клетка для хищников')->first()->id
            ],
            [
                'species' => 'Шимпанзе',
                'name' => 'Чарли',
                'age' => 12,
                'description' => 'Умный и активный шимпанзе. Любит решать головоломки и общаться с людьми.',
                'cage_id' => $cages->where('name', 'Вольер для приматов')->first()->id
            ],
            [
                'species' => 'Орангутан',
                'name' => 'Оранго',
                'age' => 15,
                'description' => 'Мудрый орангутан с рыжей шерстью. Проводит много времени, размышляя о жизни.',
                'cage_id' => $cages->where('name', 'Вольер для приматов')->first()->id
            ],
            [
                'species' => 'Пингвин',
                'name' => 'Пинки',
                'age' => 3,
                'description' => 'Веселый пингвин, который обожает плавать и играть в воде.',
                'cage_id' => $cages->where('name', 'Аквариум для морских животных')->first()->id
            ],
            [
                'species' => 'Попугай',
                'name' => 'Рио',
                'age' => 8,
                'description' => 'Яркий попугай ара, который умеет говорить и любит повторять слова посетителей.',
                'cage_id' => $cages->where('name', 'Тропический павильон')->first()->id
            ],
            [
                'species' => 'Коза',
                'name' => 'Белянка',
                'age' => 2,
                'description' => 'Дружелюбная коза, которая любит, когда её гладят дети.',
                'cage_id' => $cages->where('name', 'Детская ферма')->first()->id
            ],
            [
                'species' => 'Кролик',
                'name' => 'Пушистик',
                'age' => 1,
                'description' => 'Мягкий и пушистый кролик, любимец всех детей.',
                'cage_id' => $cages->where('name', 'Детская ферма')->first()->id
            ],
            [
                'species' => 'Сова',
                'name' => 'Мудрая',
                'age' => 6,
                'description' => 'Большая сова с проницательным взглядом. Активна в ночное время.',
                'cage_id' => $cages->where('name', 'Ночной дом')->first()->id
            ],
            [
                'species' => 'Летучая мышь',
                'name' => 'Тень',
                'age' => 4,
                'description' => 'Маленькая летучая мышь, которая спит днем и активна ночью.',
                'cage_id' => $cages->where('name', 'Ночной дом')->first()->id
            ]
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
