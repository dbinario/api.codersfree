<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//agregamos el controlador para registrar usuarios
use App\Http\Controllers\Api\RegisterController;
//agregamos el controlador para obtener las categorias
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

use App\Http\Controllers\Api\Auth\LoginController;

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

//ruta para el registro de usuarios
Route::post('register',[RegisterController::class,'store'])->name('api.v1.register');

//endpoints para las categorias
/*
Route::get('categories',[CategoryController::class,'index'])->name('api.v1.categories.index');
Route::post('categories',[CategoryController::class,'store'])->name('api.v1.categories.store');
Route::get('categories/{category}',[CategoryController::class,'show'])->name('api.v1.categories.show');
Route::put('categories/{category}',[CategoryController::class,'update'])->name('api.v1.categories.update');
Route::delete('categories/{category}',[CategoryController::class,'destroy'])->name('api.v1.categories.destroy');
*/

Route::apiResource('categories',CategoryController::class)->names('api.v1.categories');
Route::apiResource('posts',PostController::class)->names('api.v1.posts');

//ruta para el login
Route::post('login',[LoginController::class,'store'])->name('api.v1.login');