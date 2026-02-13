<?php

use App\Http\Controllers\EducacionController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\AsUri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('/perfil', PerfilController::class);
    Route::resource('/experiencialaboral',ExperienciaController::class );
    Route::resource('/habilidades',HabilidadController::class );
    Route::resource('/educacion',EducacionController::class );
    Route::resource('/proyectos',ProyectoController::class );

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
