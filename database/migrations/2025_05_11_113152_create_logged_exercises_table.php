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
        Schema::create('logged_exercises', function (Blueprint $table) {
            $table->id(); // id записи о выполненном упражнении (первичный ключ)

            // Связь с таблицей 'workout_logs' (тренировка, к которой относится это упражнение)
            $table->foreignId('workout_log_id')
                  ->constrained('workout_logs') // Внешний ключ к таблице 'workout_logs'
                  ->onDelete('cascade'); // Если тренировка удалена, все ее выполненные упражнения тоже удаляются

            // Связь с таблицей 'exercises' (какое упражнение было выполнено)
            $table->foreignId('exercise_id')
                  ->constrained('exercises') // Внешний ключ к таблице 'exercises'
                  ->onDelete('cascade'); // Если упражнение удалено из справочника, записи о его выполнении тоже удаляются
                                        // (Альтернатива: onDelete('restrict') - запретить удаление упражнения, если есть записи о его выполнении,
                                        //  или onDelete('set null') - если exercise_id может быть NULL и вы хотите сохранить запись без упр.)

            $table->unsignedInteger('order_in_workout')->default(0); // Порядковый номер упражнения в данной тренировке
            $table->text('notes')->nullable(); // Заметки пользователя к этому конкретному упражнению в данной тренировке

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
        Schema::dropIfExists('logged_exercises');
    }
};
