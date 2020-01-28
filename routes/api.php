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

Route::any('submit' , 'Api\FormHandle@store');


Route::resource('blogfeed' , 'Api\BlogFeedController');
Route::resource('categories' , 'Api\CategoriesController');
Route::resource('articles','Api\ArticlesController');
//Route::any('/viewArticle/{id}','Api\ArticlesController@show');
Route::any('allarticles','Api\BlogFeedController@allarticles');

Route::delete('articles/{id}', 'Api\ArticlesController@destroy');
Route::delete('categories/{id}', 'Api\CategoriesController@destroy');
