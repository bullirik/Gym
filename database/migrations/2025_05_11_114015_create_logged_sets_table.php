<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logged_sets', function (Blueprint $table) {
            $table->id(); // id подхода (первичный ключ)

            // Связь с таблицей 'logged_exercises' (к какому выполненному упражнению относится этот подход)
            $table->foreignId('logged_exercise_id')
                  ->constrained('logged_exercises') // Внешний ключ к таблице 'logged_exercises'
                  ->onDelete('cascade'); // Если запись о выполненном упражнении удалена, все ее подходы тоже удаляются

            $table->unsignedInteger('set_number'); // Порядковый номер подхода (обязательное)

            $table->unsignedInteger('reps')->nullable(); // Количество выполненных повторений (необязательное)
            $table->decimal('weight_kg', 8, 2)->nullable(); // Используемый вес в кг (например, 100.50 кг, необязательное)
                                                          // 8 - общее количество цифр, 2 - количество цифр после запятой

            $table->unsignedInteger('duration_seconds')->nullable(); // Продолжительность в секундах (для упражнений на время, необязательное)
            $table->decimal('distance_km', 8, 3)->nullable(); // Дистанция в км (например, 5.250 км, необязательное)

            $table->unsignedInteger('rest_after_set_seconds')->nullable(); // Отдых после этого подхода в секундах (необязательное)

            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logged_sets');
    }
};
