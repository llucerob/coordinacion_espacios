<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\RecintoController;
use App\Http\Controllers\MaterialesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/recintos/crear', [RecintoController::class, 'create'])->name('recinto.create');
    Route::post('/recintos', [RecintoController::class, 'store'])->name('recinto.store');
    route::get('/recintos', [RecintoController::class, 'index'])->name('recintos.index');
    Route::get('/recintos/{id}/editar', [RecintoController::class, 'edit'])->name('recintos.edit');
    Route::put('/recintos/{id}', [RecintoController::class, 'update'])->name('recintos.update');
    Route::delete('/recintos/{id}', [RecintoController::class, 'destroy'])->name('recintos.destroy');

    Route::get('/materiales/crear', [MaterialesController::class, 'create'])->name('material.create');
    Route::post('/materiales/guardar', [MaterialesController::class, 'store'])->name('materiales.store');
    Route::get('/materiales/asignar', [MaterialesController::class, 'asignar'])->name('materiales.asignar');
    Route::get('/materiales', [MaterialesController::class, 'index'])->name('materiales.index');
    Route::get('/materiales/{id}/editar', [MaterialesController::class, 'edit'])->name('materiales.edit');
    Route::put('/materiales/{id}', [MaterialesController::class, 'update'])->name('materiales.update');
    Route::delete('/materiales/{id}', [MaterialesController::class, 'destroy'])->name('materiales.destroy');

    Route::get('/actividades', [ActividadController::class, 'index'])->name('actividades.index');
    Route::get('/actividades/crear', [ActividadController::class, 'create'])->name('actividad.agendar');
    Route::post('/actividades/guardar', [ActividadController::class, 'store'])->name('actividad.store');
    Route::get('/actividades/{id}/editar', [ActividadController::class, 'edit'])->name('actividades.edit');
    Route::put('/actividades/{id}', [ActividadController::class, 'update'])->name('actividades.update');
    Route::delete('/actividades/{id}', [ActividadController::class, 'destroy'])->name('actividades.destroy');
    Route::get('/pantalla', [App\Http\Controllers\ActividadController::class, 'pantalla'])->name('actividades.pantalla');

});

require __DIR__.'/auth.php';