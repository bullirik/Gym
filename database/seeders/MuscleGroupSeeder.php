<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Важно импортировать DB фасад

class MuscleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Удаляем существующие записи, чтобы избежать дублирования при повторном запуске сидера
        DB::table('muscle_groups')->delete();

        // Добавляем основные группы мышц
        DB::table('muscle_groups')->insert([
            ['id' => 1, 'name_ru' => 'Грудь', 'name_en' => 'Chest'],
            ['id' => 2, 'name_ru' => 'Спина', 'name_en' => 'Back'],
            ['id' => 3, 'name_ru' => 'Ноги', 'name_en' => 'Legs'],
            ['id' => 4, 'name_ru' => 'Руки (Бицепс)', 'name_en' => 'Arms (Biceps)'],
            ['id' => 5, 'name_ru' => 'Руки (Трицепс)', 'name_en' => 'Arms (Triceps)'],
            ['id' => 6, 'name_ru' => 'Плечи', 'name_en' => 'Shoulders'],
            ['id' => 7, 'name_ru' => 'Пресс', 'name_en' => 'Abs'],
            ['id' => 8, 'name_ru' => 'Икры', 'name_en' => 'Calves'],
            ['id' => 9, 'name_ru' => 'Предплечья', 'name_en' => 'Forearms'],
            ['id' => 10, 'name_ru' => 'Ягодицы', 'name_en' => 'Glutes'],
            ['id' => 11, 'name_ru' => 'Трапеции', 'name_en' => 'Traps'],
            ['id' => 12, 'name_ru' => 'Всё тело (кардио)', 'name_en' => 'Full Body (Cardio)'],
            ['id' => 99, 'name_ru' => 'Другое', 'name_en' => 'Other'],
        ]);
    }
}
