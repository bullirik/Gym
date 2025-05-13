<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <--- ДОБАВЛЕН ИМПОРТ ДЛЯ SANCTUM

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // <--- ДОБАВЛЕН ТРЕЙТ HasApiTokens

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',     // Стандартное поле Laravel, оставляем на случай, если оно есть в таблице users
        'username', // Наше поле для логина
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Laravel автоматически хэширует пароль
        ];
    }

    /**
     * Получить все тренировки этого пользователя.
     * (Это отношение мы добавляли ранее, оно полезно)
     */
    public function workoutLogs()
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
