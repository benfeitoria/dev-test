<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* --------- Login --------- */
Route::middleware('api')->post('/login', 'AuthController@login');
Route::middleware('api')->post('/registration', 'AuthController@createLogin');

/* --------- Post --------- */
Route::middleware('api')->get('/post', 'PostController@get');
Route::middleware('api')->post('/post', 'PostController@filter');
Route::middleware('auth:web')->post('/post/save', 'PostController@save');
Route::middleware('auth:web')->post('/post/save/{id}', 'PostController@save');
Route::middleware('auth:web')->post('/post/delete', 'PostController@destroy');
Route::middleware('auth:web')->get('/autor', 'PostController@getAutores');

/* --------- Categoria --------- */
Route::middleware('api')->get('/categoria', 'CategoryController@get');
Route::middleware('auth:web')->post('/categoria', 'CategoryController@filter');
Route::middleware('auth:web')->post('/categoria/save', 'CategoryController@save');
Route::middleware('auth:web')->post('/categoria/save/{id}', 'CategoryController@save');
Route::middleware('auth:web')->post('/categoria/delete', 'CategoryController@destroy');
