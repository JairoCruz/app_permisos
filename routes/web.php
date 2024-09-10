<?php

use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/permisos', [PermisoController::class, 'index'])->name('permiso.index');
    Route::get('/registrar-permiso',[PermisoController::class, 'create'])->name('permiso.create');
    Route::post('/guardar-permiso', [PermisoController::class, 'store'])->name('permiso.store');
    Route::get('/ver-permiso/{permiso}', [PermisoController::class, 'view'])->name('permiso.view');
    Route::get('/imprimir-permiso/{permiso}', [PermisoController::class, 'imprimir'])->name('permiso.imprimir');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
