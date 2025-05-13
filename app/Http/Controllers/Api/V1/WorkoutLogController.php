<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\WorkoutLog;
use App\Models\LoggedExercise;
use App\Models\LoggedSet;
use App\Models\Exercise; // Для проверки существования упражнений
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для получения аутентифицированного пользователя
use Illuminate\Support\Facades\DB; // Для транзакций
use Illuminate\Support\Facades\Validator; // Для валидации

class WorkoutLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/v1/workouts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $workouts = WorkoutLog::where('user_id', $user->id)
            ->with([
                'loggedExercises' => function ($query) {
                    $query->orderBy('order_in_workout');
                },
                'loggedExercises.exercise:id,name_ru,gif_filename', // Загружаем только нужные поля упражнения
                'loggedExercises.loggedSets' => function ($query) {
                    $query->orderBy('set_number');
                }
            ])
            ->orderBy('date', 'desc') // Сначала последние тренировки
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Пагинация, например, по 10 тренировок на страницу

        return response()->json($workouts);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/workouts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d', // Ожидаем дату в формате ГГГГ-ММ-ДД
            'start_time' => 'nullable|date_format:H:i:s',
            'duration_minutes' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
            'logged_exercises' => 'required|array|min:1',
            'logged_exercises.*.exercise_id' => 'required|exists:exercises,id', // Упражнение должно существовать в нашей базе
            'logged_exercises.*.order_in_workout' => 'required|integer|min:0',
            'logged_exercises.*.notes' => 'nullable|string',
            'logged_exercises.*.sets' => 'required|array|min:1',
            'logged_exercises.*.sets.*.set_number' => 'required|integer|min:1',
            'logged_exercises.*.sets.*.reps' => 'nullable|integer|min:0',
            'logged_exercises.*.sets.*.weight_kg' => 'nullable|numeric|min:0',
            'logged_exercises.*.sets.*.duration_seconds' => 'nullable|integer|min:0',
            'logged_exercises.*.sets.*.distance_km' => 'nullable|numeric|min:0',
            'logged_exercises.*.sets.*.rest_after_set_seconds' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // Unprocessable Entity
        }

        $validatedData = $validator->validated();
        $workoutLog = null;

        DB::beginTransaction();
        try {
            $workoutLog = WorkoutLog::create([
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'date' => $validatedData['date'],
                'start_time' => $validatedData['start_time'] ?? null,
                'duration_minutes' => $validatedData['duration_minutes'] ?? null,
                'notes' => $validatedData['notes'] ?? null,
            ]);

            foreach ($validatedData['logged_exercises'] as $loggedExerciseData) {
                $loggedExercise = $workoutLog->loggedExercises()->create([
                    'exercise_id' => $loggedExerciseData['exercise_id'],
                    'order_in_workout' => $loggedExerciseData['order_in_workout'],
                    'notes' => $loggedExerciseData['notes'] ?? null,
                ]);

                foreach ($loggedExerciseData['sets'] as $setData) {
                    $loggedExercise->loggedSets()->create([
                        'set_number' => $setData['set_number'],
                        'reps' => $setData['reps'] ?? null,
                        'weight_kg' => $setData['weight_kg'] ?? null,
                        'duration_seconds' => $setData['duration_seconds'] ?? null,
                        'distance_km' => $setData['distance_km'] ?? null,
                        'rest_after_set_seconds' => $setData['rest_after_set_seconds'] ?? null,
                    ]);
                }
            }

            DB::commit();

            // Загружаем созданную тренировку со всеми связями для ответа
            $workoutLog->load([
                'loggedExercises' => function ($query) {
                    $query->orderBy('order_in_workout');
                },
                'loggedExercises.exercise:id,name_ru,gif_filename',
                'loggedExercises.loggedSets' => function ($query) {
                    $query->orderBy('set_number');
                }
            ]);

            return response()->json($workoutLog, 201); // 201 Created

        } catch (\Exception $e) {
            DB::rollBack();
            // Можно добавить логирование ошибки $e->getMessage()
            return response()->json(['error' => 'Ошибка при сохранении тренировки: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     * GET /api/v1/workouts/{workoutLog}
     *
     * @param  \App\Models\WorkoutLog  $workoutLog (Route Model Binding)
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(WorkoutLog $workoutLog)
    {
        // Проверка, что тренировка принадлежит аутентифицированному пользователю
        if (Auth::id() !== $workoutLog->user_id) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $workoutLog->load([
            'loggedExercises' => function ($query) {
                $query->orderBy('order_in_workout');
            },
            'loggedExercises.exercise:id,name_ru,gif_filename',
            'loggedExercises.loggedSets' => function ($query) {
                $query->orderBy('set_number');
            }
        ]);

        return response()->json($workoutLog);
    }

    /**
     * Update the specified resource in storage.
     * (Пока не реализуем для MVP)
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkoutLog  $workoutLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkoutLog $workoutLog)
    {
        // Логика обновления (позже)
        // Не забудьте проверить права доступа Auth::id() === $workoutLog->user_id
    }

    /**
     * Remove the specified resource from storage.
     * (Пока не реализуем для MVP)
     * @param  \App\Models\WorkoutLog  $workoutLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkoutLog $workoutLog)
    {
        // Логика удаления (позже)
        // Не забудьте проверить права доступа Auth::id() === $workoutLog->user_id
    }
}
