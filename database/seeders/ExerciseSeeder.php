<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Важно!
use Carbon\Carbon; // Для работы с датами

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->delete(); // Очищаем таблицу перед заполнением

        $exercises = [
            ['name_ru' => 'Попеременные молотковые сгибания на бицепс', 'name_en' => 'Alternate Hammer Curl', 'gif_filename' => 'alternate_hammer_curl.gif', 'muscle_group_main_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Попеременные касания пяток (кранчи)', 'name_en' => 'Alternate Heel Touchers', 'gif_filename' => 'alternate_heel_touchers.gif', 'muscle_group_main_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Попеременные подъемы ног', 'name_en' => 'Alternate Leg Raise', 'gif_filename' => 'alternate_leg_raise.gif', 'muscle_group_main_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Подтягивания лучника', 'name_en' => 'Archer Pull Up', 'gif_filename' => 'archer_pull_up.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Отжимания лучника', 'name_en' => 'Archer Push Up', 'gif_filename' => 'archer_push_up.gif', 'muscle_group_main_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Жим Арнольда', 'name_en' => 'Arnold Press', 'gif_filename' => 'arnold_press.gif', 'muscle_group_main_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Махи гантелями "Вокруг света"', 'name_en' => 'Around The World', 'gif_filename' => 'around_the_world.gif', 'muscle_group_main_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Подтягивания обратным хватом с ассистентом', 'name_en' => 'Assisted Chin Up', 'gif_filename' => 'assisted_chin_up.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Приседания "Пистолетик" с поддержкой', 'name_en' => 'Assisted Pistol Squat', 'gif_filename' => 'assisted_pistol_squat.gif', 'muscle_group_main_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Подтягивания с ассистентом', 'name_en' => 'Assisted Pull Up', 'gif_filename' => 'assisted_pull_up.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Отжимания на трицепс с поддержкой (на брусьях)', 'name_en' => 'Assisted Triceps Dip', 'gif_filename' => 'assisted_triceps_dip.gif', 'muscle_group_main_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Экстензия спины (гиперэкстензия)', 'name_en' => 'Back Extension', 'gif_filename' => 'back_extension.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => '"Доброе утро" с эспандером', 'name_en' => 'Band Good Morning', 'gif_filename' => 'band_good_morning.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Разведение эспандера (на задние дельты)', 'name_en' => 'Band Pull Apart', 'gif_filename' => 'band_pull_apart.gif', 'muscle_group_main_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Жим штанги лежа', 'name_en' => 'Barbell Bench Press', 'gif_filename' => 'barbell_bench_press.gif', 'muscle_group_main_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Тяга штанги в наклоне', 'name_en' => 'Barbell Bent Over Row', 'gif_filename' => 'barbell_bent_over_row.gif', 'muscle_group_main_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Сгибания рук со штангой на бицепс', 'name_en' => 'Barbell Bicep Curl', 'gif_filename' => 'barbell_bicep_curl.gif', 'muscle_group_main_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Подъемы на икры со штангой', 'name_en' => 'Barbell Calf Raise', 'gif_filename' => 'barbell_calf_raise.gif', 'muscle_group_main_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Фронтальные подъемы штанги', 'name_en' => 'Barbell Front Raise', 'gif_filename' => 'barbell_front_raise.gif', 'muscle_group_main_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_ru' => 'Фронтальные приседания со штангой', 'name_en' => 'Barbell Front Squat', 'gif_filename' => 'barbell_front_squat.gif', 'muscle_group_main_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('exercises')->insert($exercises);
    }
}
