<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CageController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| 
| 
| 
|
*/

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Публичные маршруты (доступны всем)
Route::get('/cages', [CageController::class, 'index'])->name('cages.index');
Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');

// Защищенные маршруты для авторизованных пользователей
Route::middleware('auth')->group(function () {
    // Создание и редактирование клеток
    Route::get('/cages/create', [CageController::class, 'create'])->name('cages.create');
    Route::post('/cages', [CageController::class, 'store'])->name('cages.store');
    Route::get('/cages/{cage}/edit', [CageController::class, 'edit'])->name('cages.edit');
    Route::put('/cages/{cage}', [CageController::class, 'update'])->name('cages.update');
    Route::delete('/cages/{cage}', [CageController::class, 'destroy'])->name('cages.destroy');
    
    // Создание и редактирование животных
    Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create');
    Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store');
    Route::get('/animals/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
    Route::put('/animals/{animal}', [AnimalController::class, 'update'])->name('animals.update');
    Route::delete('/animals/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
});

// Публичные маршруты с параметрами (должны быть ПОСЛЕ /create и /edit)
Route::get('/cages/{cage}', [CageController::class, 'show'])->name('cages.show');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');

// Маршруты авторизации
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
