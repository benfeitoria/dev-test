<?php

use Illuminate\Support\Facades\Route;


//ROTAS PROTEGIDAS POR JWT
Route::group([
    'prefix'        => 'v1',
    'namespace'     => 'Api\v1',
], function (){

    Route::group(['prefix'=> 'post', 'as'=> '.post'], function(){
        Route::get('/',                     'SiteCtrl@index');
        Route::get('/showPost/{id}',        'SiteCtrl@showPost');        
    });

    Route::group(['prefix'=> 'categoria', 'as'=> '.categoria'], function(){
        Route::get('/',                     'SiteCtrl@getCategorias');
    });

    Route::group(['prefix'=> 'autor', 'as'=> '.autor'], function(){
        Route::get('/',                     'SiteCtrl@getAutores');
    });
});

