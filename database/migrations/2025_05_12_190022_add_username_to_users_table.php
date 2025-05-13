<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Добавляем колонку 'username' после колонки 'name' (или 'email', если 'name' нет)
            // Сделаем ее уникальной и разрешим быть null на уровне БД,
            // но валидацию на обязательность и уникальность будем делать в AuthController.
            // Если хотите строго на уровне БД, уберите ->nullable().
            $table->string('username')->unique()->after('name'); // Или ->after('email') если поля 'name' нет
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
