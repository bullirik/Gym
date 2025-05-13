<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'date',
        'start_time',
        'duration_minutes',
        'notes',
    ];

    protected $casts = [
        'date' => 'date', // Автоматическое преобразование в объект Carbon/Date
    ];

    /**
     * Получить пользователя, которому принадлежит эта тренировка.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить все выполненные упражнения в этой тренировке.
     */
    public function loggedExercises()
    {
        // 'workout_log_id' - внешний ключ в таблице 'logged_exercises'
        // 'id' - локальный ключ в таблице 'workout_logs' (по умолчанию)
        return $this->hasMany(LoggedExercise::class);
    }
}
