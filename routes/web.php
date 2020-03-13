<?php

use Illuminate\Support\Facades\Route;
//rotas web
Route::get('/', 			['as' => 'index', 'uses' => 'Web\SiteCtrl@index']);
Route::get('/post/{id?}', 	['as' => 'post', 'uses' => 'Web\SiteCtrl@showPost']);
Route::get('/post/busca', 	['as' => 'post', 'uses' => 'Web\SiteCtrl@busca']);


Auth::routes();
Auth::routes();

// grupos de rotas da visão do sistema
Route::group(['prefix' => 'sistema', 'as' => 'sistema', 'middleware' => 'auth'], function(){
    // rota home
    Route::get('/','HomeController@index')->name('.index');

    // rotas do categoria
	Route::group(['prefix' => 'categoria', 'as' => '.categoria'], function(){
	    Route::get('/',                     ['as' => '.index', 'uses' => 'Sistema\CategoriaCtrl@index'] );
	    Route::get('/novo',                 ['as' => '.novo', 'uses' => 'Sistema\CategoriaCtrl@create'] );
	    Route::post('/salvar',              ['as' => '.salvar', 'uses' => 'Sistema\CategoriaCtrl@store'] );
	    Route::get('/editar/{id}',          ['as' => '.editar', 'uses' => 'Sistema\CategoriaCtrl@edit'] );
		Route::put('atualizar/{id}',        ['as' => '.atualizar', 'uses' => 'Sistema\CategoriaCtrl@update'] );
		//mudei a roda de excluir para Ger para poder usar a lógica do componente de DataTable
		Route::get('excluir/{id}',       ['as' => '.excluir', 'uses' => 'Sistema\CategoriaCtrl@destroy'] );
    });
    
    // rotas do posts
	Route::group(['prefix' => 'post', 'as' => '.post'], function(){
	    Route::get('/',                     ['as' => '.index', 'uses' => 'Sistema\PostCtrl@index'] );
	    Route::get('/novo',                 ['as' => '.novo', 'uses' => 'Sistema\PostCtrl@create'] );
	    Route::post('/salvar',              ['as' => '.salvar', 'uses' => 'Sistema\PostCtrl@store'] );
	    Route::get('/editar/{id}',          ['as' => '.editar', 'uses' => 'Sistema\PostCtrl@edit'] );
		Route::put('atualizar/{id}',        ['as' => '.atualizar', 'uses' => 'Sistema\PostCtrl@update'] );
		//mudei a roda de excluir para Ger para poder usar a lógica do componente de DataTable
		Route::get('excluir/{id}',       	['as' => '.excluir', 'uses' => 'Sistema\PostCtrl@destroy'] );
	});
});