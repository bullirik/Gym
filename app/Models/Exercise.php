<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_ru',
        'name_en',
        'description_ru',
        'gif_filename',
        'video_url',
        'muscle_group_main_id',
        'is_bodyweight',
        'is_custom_exercise',
        'user_id_creator',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы к нативным типам.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_bodyweight' => 'boolean',
        'is_custom_exercise' => 'boolean',
    ];

    /**
     * Определяем отношение "принадлежит к" с моделью MuscleGroup.
     * Каждое упражнение принадлежит к одной основной группе мышц.
     */
    public function mainMuscleGroup()
    {
        // 'muscle_group_main_id' - это внешний ключ в таблице 'exercises'
        // 'id' - это ключ в связанной таблице 'muscle_groups' (по умолчанию)
        return $this->belongsTo(MuscleGroup::class, 'muscle_group_main_id');
    }

    /**
     * Определяем отношение "принадлежит к" с моделью User (для создателя кастомного упражнения).
     * Каждое кастомное упражнение создано одним пользователем.
     */
    public function creator()
    {
        // 'user_id_creator' - это внешний ключ в таблице 'exercises'
        // 'id' - это ключ в связанной таблице 'users' (по умолчанию)
        return $this->belongsTo(User::class, 'user_id_creator');
    }

    /**
     * Упражнения, выполненные в рамках тренировок (связь "многие ко многим" через LoggedExercise).
     * Это более сложная связь, для MVP мы можем ее не определять здесь,
     * а получать данные через модель LoggedExercise.
     * Если бы мы хотели получить все тренировки, где было это упражнение:
     * return $this->belongsToMany(WorkoutLog::class, 'logged_exercises', 'exercise_id', 'workout_log_id');
     */

    /**
     * Получить все записи о выполнении этого упражнения.
     */
    public function loggedExercises()
    {
        return $this->hasMany(LoggedExercise::class);
    }
}
