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
        // Создаем таблицу 'muscle_groups'
        Schema::create('muscle_groups', function (Blueprint $table) {
            $table->id(); // Поле id: BIGINT UNSIGNED, Auto Increment, Primary Key
            $table->string('name_ru')->unique(); // Поле name_ru: VARCHAR, уникальное, обязательное
            $table->string('name_en')->nullable(); // Поле name_en: VARCHAR, может быть пустым (необязательное)
            // $table->timestamps(); // Автоматически создает поля created_at и updated_at (TIMESTAMPS)
                                  // Если они вам нужны для этой таблицы, раскомментируйте.
                                  // В нашем плане backend_entities_v2 для MuscleGroup они не указаны,
                                  // но для справочников иногда полезно знать, когда они были созданы/обновлены.
                                  // Для MVP они не критичны, можно оставить закомментированными.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Удаляем таблицу 'muscle_groups', если она существует
        Schema::dropIfExists('muscle_groups');
    }
};
