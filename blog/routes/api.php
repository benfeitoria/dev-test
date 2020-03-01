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

Route::middleware(['auth:api'])->group(function(){
    /**
     * POST CATEGORIES
     */
    Route::get('post-categories','PostCategoriesController@index');
    Route::get('post-categories/all','PostCategoriesController@all');
    Route::post('post-categories','PostCategoriesController@create');
    Route::put('post-categories','PostCategoriesController@update');
    Route::delete('post-categories/{id}','PostCategoriesController@delete');

    /**
     * POSTS
     */
    Route::get('post','PostController@index');
    Route::post('post','PostController@create');
    Route::post('post/update','PostController@update');
    Route::delete('post/{id}','PostController@delete');
    Route::put('post/publication/{id}','PostController@publicationOrRemove');

});

Route::get('home/posts','PostController@recent');
Route::get('home/categories','PostCategoriesController@categoriesHasPost');
Route::get('home/authors',function(){
return \App\User::select('name','id')->whereHas('posts',function($query){
    return $query->whereNotNull('publication_date');
})->get();
});




