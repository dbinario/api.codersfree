<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//agregamos el controlador para registrar usuarios
use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[RegisterController::class,'store'])->name('api.v1.register');