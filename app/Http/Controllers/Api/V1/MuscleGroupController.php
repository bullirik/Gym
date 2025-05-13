<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MuscleGroup; // Импортируем нашу модель
use Illuminate\Http\Request;

class MuscleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/v1/muscle-groups
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Получаем все записи из таблицы muscle_groups
        $muscleGroups = MuscleGroup::orderBy('name_ru')->get(['id', 'name_ru', 'name_en']); // Сортируем по русскому названию

        // Возвращаем данные в формате JSON
        return response()->json($muscleGroups);
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
     * (Пока не реализуем для MVP, если не нужен отдельный эндпоинт для одной группы)
     * @param  \App\Models\MuscleGroup  $muscleGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MuscleGroup $muscleGroup)
    {
        // return response()->json($muscleGroup);
    }

    /**
     * Update the specified resource in storage.
     * (Пока не реализуем для MVP)
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MuscleGroup  $muscleGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MuscleGroup $muscleGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * (Пока не реализуем для MVP)
     * @param  \App\Models\MuscleGroup  $muscleGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MuscleGroup $muscleGroup)
    {
        //
    }
}
