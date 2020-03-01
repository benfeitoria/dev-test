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

Route::get('/', function () {return view('welcome');});
Route::get('/post-show/{id}', function ($id) {
    $post  =  \App\Model\Post::find($id);
    if(!$post){
        return redirect('/');
    }
    return view('post-show',['post'=>$post]);
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/post-categories', function () {return view('post_categories');});
    Route::get('/posts', function () {return view('posts');});
});
