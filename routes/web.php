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
Route::get("images/{image}", "App\Http\Controllers\ImageController@getImage");

Route::prefix("admin")->group(function () {
    Route::prefix("categories")->group(function () {
        Route::get("/", 'App\Http\Controllers\CategoryController@index');
    });
    Route::prefix("configs")->group(function () {
        Route::get("/", 'App\Http\Controllers\ConfigController@index');
    });



});

Route::prefix("adminData")->group(function () {
    Route::prefix("categories")->group(function () {
        Route::get("/", 'App\Http\Controllers\CategoryController@ajaxAll');
        Route::post("/", 'App\Http\Controllers\CategoryController@store');
        Route::get("/{category}", 'App\Http\Controllers\CategoryController@ajaxOne');
        Route::post("{category}", 'App\Http\Controllers\CategoryController@update');
        Route::delete("{category}", 'App\Http\Controllers\CategoryController@destroy');
        Route::patch("{category}", 'App\Http\Controllers\CategoryController@restore');
    });

    Route::prefix("configs")->group(function () {
        Route::get("/", 'App\Http\Controllers\ConfigController@ajaxAll');
        Route::post("/", 'App\Http\Controllers\ConfigController@store');
        Route::get("/{config}", 'App\Http\Controllers\ConfigController@ajaxOne');
        Route::post("{config}", 'App\Http\Controllers\ConfigController@update');
        Route::delete("{config}", 'App\Http\Controllers\ConfigController@destroy');
        Route::patch("{config}", 'App\Http\Controllers\ConfigController@restore');
    });
    Route::prefix("theme-configs")->group(function () {
        Route::get("/", 'App\Http\Controllers\ThemeConfigController@ajaxAll');
        Route::post("/", 'App\Http\Controllers\ThemeConfigController@store');
        Route::get("/{config}", 'App\Http\Controllers\ThemeConfigController@ajaxOne');
        Route::post("{config}", 'App\Http\Controllers\ThemeConfigController@update');
        Route::delete("{config}", 'App\Http\Controllers\ThemeConfigController@destroy');
        Route::patch("{config}", 'App\Http\Controllers\ThemeConfigController@restore');
    });

});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
