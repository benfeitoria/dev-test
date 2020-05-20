<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('categorias',         'API\\CategoriasController@index');
Route::delete('categorias/{id}', 'API\\CategoriasController@delete'); //->middleware('auth:api');
Route::post('categorias',        'API\\CategoriasController@create'); //->middleware('auth:api');

Route::get('postagens',         'API\\PostagensController@index');
Route::get('postagem/{id}',     'API\\PostagensController@get');
Route::delete('postagens/{id}', 'API\\PostagensController@delete'); //->middleware('auth:api');
Route::post('postagem',         'API\\PostagensController@create'); //->middleware('auth:api');
