<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cage;

class CageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cages = [
            [
                'name' => 'Большая клетка для хищников',
                'capacity' => 5,
                'description' => 'Просторная клетка для крупных хищных животных с отдельными зонами для отдыха и активности.'
            ],
            [
                'name' => 'Вольер для приматов',
                'capacity' => 8,
                'description' => 'Высокий вольер с деревьями и канатами для обезьян и других приматов.'
            ],
            [
                'name' => 'Аквариум для морских животных',
                'capacity' => 3,
                'description' => 'Большой аквариум с морской водой для пингвинов и других морских обитателей.'
            ],
            [
                'name' => 'Тропический павильон',
                'capacity' => 6,
                'description' => 'Теплый павильон с тропическими растениями для экзотических птиц и рептилий.'
            ],
            [
                'name' => 'Детская ферма',
                'capacity' => 10,
                'description' => 'Открытая площадка для домашних животных, где дети могут взаимодействовать с ними.'
            ],
            [
                'name' => 'Ночной дом',
                'capacity' => 4,
                'description' => 'Специально оборудованное помещение для ночных животных с приглушенным освещением.'
            ]
        ];

        foreach ($cages as $cage) {
            Cage::create($cage);
        }
    }
}
