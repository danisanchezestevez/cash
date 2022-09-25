<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::get('categories-list', [\App\Http\Controllers\CategoryController::class, 'list'])->name('categories-list');
    Route::get('category-detail/{id}', [\App\Http\Controllers\CategoryController::class, 'detail'])->name('category-detail');
    Route::post('getModelsByBrand', [\App\Http\Controllers\BrandModelController::class, 'getModelsByBrand']);
    Route::post('answers-save', [\App\Http\Controllers\AnswerController::class, 'saveForm'])->name('answers-save');
    Route::get('users-list', [\App\Http\Controllers\UserController::class, 'list'])->name('users-list');
    Route::get('users-list/{page}', [\App\Http\Controllers\UserController::class, 'list'])->name('users-list-page');

    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
});


