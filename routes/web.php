<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;


/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', [RegistroController::class, 'index']);
