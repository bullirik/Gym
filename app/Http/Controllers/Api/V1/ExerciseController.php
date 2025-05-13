<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Exercise; // Импортируем нашу модель
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/v1/exercises
     * GET /api/v1/exercises?muscle_group_id=1
     * GET /api/v1/exercises?search=жим
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Начинаем строить запрос к модели Exercise
        $query = Exercise::query();

        // Если в запросе есть параметр 'muscle_group_id', фильтруем по нему
        if ($request->has('muscle_group_id')) {
            $query->where('muscle_group_main_id', $request->input('muscle_group_id'));
        }

        // Если в запросе есть параметр 'search', фильтруем по названию (русскому или английскому)
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_ru', 'like', '%' . $searchTerm . '%')
                  ->orWhere('name_en', 'like', '%' . $searchTerm . '%');
            });
        }

        // Выбираем нужные поля и добавляем связанную модель группы мышц для отображения ее имени
        // Сортируем по русскому названию упражнения
        // Добавляем пагинацию (по умолчанию 15 записей на страницу)
        $exercises = $query->with('mainMuscleGroup:id,name_ru') // Загружаем только id и name_ru из связанной модели
                             ->select(['id', 'name_ru', 'name_en', 'gif_filename', 'muscle_group_main_id', 'is_bodyweight'])
                             ->orderBy('name_ru')
                             ->paginate(20); // Например, 20 упражнений на страницу

        return response()->json($exercises);
    }

    /**
     * Store a newly created resource in storage.
     * (Пока не реализуем для MVP)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /api/v1/exercises/{exercise}
     *
     * @param  \App\Models\Exercise  $exercise (Route Model Binding)
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Exercise $exercise)
    {
        // Загружаем связанную модель группы мышц, если она еще не загружена
        $exercise->loadMissing('mainMuscleGroup:id,name_ru');

        return response()->json($exercise);
    }

    /**
     * Update the specified resource in storage.
     * (Пока не реализуем для MVP)
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * (Пока не реализуем для MVP)
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}
