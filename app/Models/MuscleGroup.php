<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuscleGroup extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel по умолчанию определит имя таблицы как 'muscle_groups' (мн. число от 'MuscleGroup').
     * Если бы имя таблицы было другим, мы бы указали:
     * protected $table = 'my_muscle_groups_table';
     */

    /**
     * Указывает, используются ли временные метки created_at и updated_at.
     * В нашей миграции для muscle_groups мы их не добавляли (или закомментировали).
     * Если вы их добавили в миграции, эту строку можно удалить или установить в true.
     */
    public $timestamps = false; // Если created_at и updated_at не используются для этой таблицы

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_ru',
        'name_en',
        // 'id' - обычно не нужно добавлять в fillable, если он автоинкрементный
    ];

    /**
     * Определяем отношение "один ко многим" с моделью Exercise.
     * Одна группа мышц может быть основной для многих упражнений.
     */
    public function exercises()
    {
        // 'muscle_group_main_id' - это внешний ключ в таблице 'exercises'
        // 'id' - это локальный ключ в таблице 'muscle_groups' (по умолчанию)
        return $this->hasMany(Exercise::class, 'muscle_group_main_id');
    }
}
