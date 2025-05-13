<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggedExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_log_id',
        'exercise_id',
        'order_in_workout',
        'notes',
    ];

    /**
     * Получить тренировку, к которой относится это выполненное упражнение.
     */
    public function workoutLog()
    {
        return $this->belongsTo(WorkoutLog::class);
    }

    /**
     * Получить информацию об упражнении из справочника.
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Получить все подходы для этого выполненного упражнения.
     */
    public function loggedSets()
    {
        // 'logged_exercise_id' - внешний ключ в таблице 'logged_sets'
        // 'id' - локальный ключ в таблице 'logged_exercises' (по умолчанию)
        return $this->hasMany(LoggedSet::class);
    }
}
