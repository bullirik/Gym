<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggedSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'logged_exercise_id',
        'set_number',
        'reps',
        'weight_kg',
        'duration_seconds',
        'distance_km',
        'rest_after_set_seconds',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2', // Для корректного отображения и сохранения десятичных чисел
        'distance_km' => 'decimal:3',
    ];

    /**
     * Получить выполненное упражнение, к которому относится этот подход.
     */
    public function loggedExercise()
    {
        return $this->belongsTo(LoggedExercise::class);
    }
}
