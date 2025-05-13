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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id(); // id упражнения (первичный ключ, автоинкремент)

            $table->string('name_ru'); // Название упражнения на русском (обязательное)
            $table->string('name_en')->nullable(); // Название упражнения на английском (из CSV, может быть пустым для кастомных)

            $table->text('description_ru')->nullable(); // Описание техники на русском (необязательное)
            $table->string('gif_filename')->nullable(); // Имя файла GIF-анимации (из CSV)
            $table->string('video_url')->nullable(); // Ссылка на видео (необязательное)

            // Связь с таблицей 'muscle_groups' для основной группы мышц
            // onDelete('set null') означает, что если группа мышц будет удалена,
            // то в этом упражнении поле muscle_group_main_id станет NULL.
            $table->foreignId('muscle_group_main_id')
                  ->nullable() // Может быть не указана
                  ->constrained('muscle_groups') // Внешний ключ к таблице 'muscle_groups'
                  ->onDelete('set null'); // Действие при удалении связанной группы мышц

            $table->boolean('is_bodyweight')->default(false); // Упражнение с собственным весом? (по умолчанию нет)
            $table->boolean('is_custom_exercise')->default(false); // Упражнение добавлено пользователем? (по умолчанию нет)

            // Связь с таблицей 'users' для создателя кастомного упражнения
            // onDelete('cascade') означает, что если пользователь будет удален,
            // то все его кастомные упражнения также будут удалены.
            // Альтернатива: onDelete('set null'), если хотите сохранять упражнения.
            $table->foreignId('user_id_creator')
                  ->nullable() // Только для is_custom_exercise = true
                  ->constrained('users') // Внешний ключ к таблице 'users'
                  ->onDelete('cascade'); // Действие при удалении пользователя-создателя

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
        Schema::dropIfExists('exercises');
    }
};
