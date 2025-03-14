<?php

use App\Http\Controllers\AutorizacionPermisoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/tipo-permisos', [PermisoController::class, 'tipo_permisos'])->name('permiso-tipos');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/tipo-permisos', [PermisoController::class, 'tipo_permisos'])->name('permiso-tipos');
    Route::get('/jefes-empleado',[PermisoController::class, 'jefes_x_empleados'])->name('jefes-empleado');
    Route::get('/permisos', [PermisoController::class, 'index'])->name('permiso.index');
    Route::get('/registrar-permiso',[PermisoController::class, 'create'])->name('permiso.create');
    Route::post('/guardar-permiso', [PermisoController::class, 'store'])->name('permiso.store');
    Route::get('/ver-permiso/{permiso}', [PermisoController::class, 'view'])->name('permiso.view');
    //Route::get('/modificar-permiso/{permiso}', [PermisoController::class,'edit'])->name('permiso.edit');
    Route::get('/modificar-permiso', [PermisoController::class,'edit'])->name('permiso.edit');
    Route::put('/modificar-permiso/{permiso}', [PermisoController::class,'update'])->name('permiso.update');
    Route::get('/imprimir-permiso/{permiso}', [PermisoController::class, 'imprimir'])->name('permiso.imprimir');
    Route::get('/disponibilidad', action: [PermisoController::class, 'disponibilidad'])->name('permiso.disponibilidad');
    Route::get('/registro-permiso-com', [PermisoController::class, 'permiso_comp'])->name('permiso.permiso_comp');


    Route::get('/permiso-autorizacion',[AutorizacionPermisoController::class, 'index'])->name('autorizacion-permiso');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
