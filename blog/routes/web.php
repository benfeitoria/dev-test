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

Route::get('/', 'Postagens@get');
Route::get('/postagem/{id}', function ($id) {
    return view('postagem', [ 'id' => $id ]);
});

Auth::routes();

Route::get('/home',       'HomeController@index')->name('home');
Route::get('/categorias', 'HomeController@categorias')->name('categorias');
