<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', 'App\Http\Controllers\API\UserController@index')->name('login');
Route::post('/logout', 'App\Http\Controllers\API\UserController@logout')->name('logout');
Route::get('/user', 'App\Http\Controllers\API\UserController@me');
Route::post('/register', 'App\Http\Controllers\API\UserController@register');

Route::patch('/edit-profil/{id}','App\Http\Controllers\API\EditProfilController@update');

Route::post('/tambah-game','App\Http\Controllers\API\GameController@store');
Route::patch('/edit-game/{id}','App\Http\Controllers\API\GameController@update');
Route::delete('/delete-game','App\Http\Controllers\API\GameController@delete');
Route::get('/games','App\Http\Controllers\API\GameController@index');
Route::get('/game/{id}','App\Http\Controllers\API\GameController@show');

Route::post('/tambah-review','App\Http\Controllers\API\ReviewController@store');
Route::patch('/edit-review/{user_id}/{game_id}','App\Http\Controllers\API\ReviewController@update');
Route::delete('/delete-review/{user_id}/{game_id}','App\Http\Controllers\API\ReviewController@delete');
Route::get('/review','App\Http\Controllers\API\ReviewController@show');
