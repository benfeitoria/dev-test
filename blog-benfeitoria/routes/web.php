<?php

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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/categorias', 'CategoriaController@index')->name('categorias');

    Route::get('/categorias/cadastrar', 'CategoriaController@register')->name('cadastrarCategoria');

    Route::post('/categorias/cadastrar', 'CategoriaController@store')->name('salvarCategoria');

    Route::post('/categorias/deletar', 'CategoriaController@destroy')->name('deletarCategoria');

    Route::get('posts/cadastrar', 'PostController@register')->name('cadastrarPost');

    Route::get('posts/cadastrar/{id}', 'PostController@register')->name('editarPost');

    Route::post('posts/cadastrar', 'PostController@store')->name('salvarPost');
});

Route::get('/', 'PostController@index');

Route::get('/posts', 'PostController@index')->name('posts');

Route::get('/usuario/cadastrar', 'UserController@register')->name('cadastrarUsuario');

Route::post('/usuario/cadastrar', 'UserController@store')->name('salvarUsuario');

Route::get('posts/view/{id}', 'PostController@view');

Auth::routes();
