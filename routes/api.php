<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MuscleGroupController;
use App\Http\Controllers\Api\V1\ExerciseController;
use App\Http\Controllers\Api\V1\WorkoutLogController;
use App\Http\Controllers\Api\V1\AuthController; // Импорт AuthController

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Маршруты для аутентификации (не требуют защиты Sanctum для доступа)
// Доступны по URL: /api/v1/auth/register и /api/v1/auth/login
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Группа маршрутов API версии 1
Route::prefix('v1')->group(function () {

    // ТЕСТОВЫЙ GET МАРШРУТ
    // Доступен по URL: /api/v1/test-api
    Route::get('/test-api', function () {
        return response()->json(['message' => 'API v1 GET test route is working!']);
    });

    // ТЕСТОВЫЙ POST МАРШРУТ (который мы добавляли для отладки)
    // Доступен по URL: /api/v1/test-post
    Route::post('/test-post', function (Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Log::info('TEST POST ROUTE HIT - Request Data:', $request->all());
        return response()->json([
            'message' => 'POST request to v1/test-post received!',
            'data_received' => $request->all()
        ]);
    });

    // Маршруты для Групп Мышц (доступны всем)
    // Доступен по URL: /api/v1/muscle-groups
    Route::get('/muscle-groups', [MuscleGroupController::class, 'index']);

    // Маршруты для Упражнений (доступны всем)
    // Доступен по URL: /api/v1/exercises
    Route::get('/exercises', [ExerciseController::class, 'index']);
    // Доступен по URL: /api/v1/exercises/{id_упражнения}
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);

    // Защищенные маршруты (требуют аутентификации через Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        // Маршрут для выхода пользователя
        // Доступен по URL: /api/v1/auth/logout (POST)
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        
        // Маршрут для получения информации о текущем аутентифицированном пользователе
        // Доступен по URL: /api/v1/auth/user (GET)
        Route::get('/auth/user', [AuthController::class, 'user']);

        // Маршруты для Тренировок (Workout Logs)
        // Доступен по URL: /api/v1/workouts (POST для создания, GET для списка)
        Route::post('/workouts', [WorkoutLogController::class, 'store']);
        Route::get('/workouts', [WorkoutLogController::class, 'index']);
        // Доступен по URL: /api/v1/workouts/{id_тренировки} (GET)
        Route::get('/workouts/{workoutLog}', [WorkoutLogController::class, 'show']);
        // Route::put('/workouts/{workoutLog}', [WorkoutLogController::class, 'update']); // Для будущего
        // Route::delete('/workouts/{workoutLog}', [WorkoutLogController::class, 'destroy']); // Для будущего
    }); // Конец группы middleware('auth:sanctum')
}); // Конец группы prefix('v1')
