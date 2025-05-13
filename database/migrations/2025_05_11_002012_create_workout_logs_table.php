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
        Schema::create('workout_logs', function (Blueprint $table) {
            $table->id(); // id записи о тренировке (первичный ключ, автоинкремент)

            // Связь с таблицей 'users'
            $table->foreignId('user_id')
                  ->constrained('users') // Внешний ключ к таблице 'users'
                  ->onDelete('cascade'); // Если пользователь удален, его тренировки тоже удаляются

            $table->string('name'); // Название тренировки (обязательное)
            $table->date('date');   // Дата проведения тренировки (обязательное)
            $table->time('start_time')->nullable(); // Время начала (необязательное)
            $table->integer('duration_minutes')->nullable(); // Общая продолжительность в минутах (необязательное)
            $table->text('notes')->nullable(); // Общие заметки пользователя к тренировке (необязательное)

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
        Schema::dropIfExists('workout_logs');
    }
};
