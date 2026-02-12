<?php

use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\AsUri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $user = User::with(['perfiles'])->findOrFail(Auth::id());
        return view('dashboard', compact('user'));
    })->name('dashboard');

    Route::resource('/experiencialaboral',ExperienciaController::class );

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
