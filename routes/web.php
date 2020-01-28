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

Route::get('/', 'BlogFeedController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/addArticle','ArticlesController@addArticle');
Route::get('/setArticle/{id}','ArticlesController@addArticle');
Route::get('/addCategory','CategoriesController@addCategory');
Route::get('/showArticle/{id}','BlogFeedController@viewArticle');
