<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Маршрут для главной страницы
// Когда пользователь заходит на http://gym.test/
// Laravel будет искать и отображать файл resources/views/app.blade.php
Route::get('/', function () {
    return view('app'); // 'app' - это имя вашего Blade-файла без расширения .blade.php
});

// Если у вас есть стандартная страница приветствия Laravel, и вы хотите ее сохранить
// под другим адресом, вы можете оставить или добавить что-то вроде:
// Route::get('/welcome', function () {
//     return view('welcome');
// });
