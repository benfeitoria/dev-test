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

/* ---------- Login/Registro ---------- */
/* Route::get('/', function () {
    return view('post/list');
}); */

Route::group(['middleware' => ['web']], function () {
    
    Route::get('/', function () {
        return view('post/list');
    });

    Route::get('/login', ['as' => 'login', function () {
        return view('login');
    }]);
    
    Route::get('/registration', function () {
        return view('registration');
    });

    Route::get('logout', 'AuthController@logout');

    /* ---------- Post ---------- */
    Route::middleware('auth:web')->get('post/add', function () {
        return view('post/add');
    });

    Route::middleware('auth:web')->get('post/admin', function () {
        return view('post/admin');
    });

    Route::get('post/{id}', function (App\Models\Post $posts, $id) {
        $data = $posts::where('id', $id)->with('category','autor')->get()->map(function ($post) {
            $post->img = $post->img();
            return $post;
        });
        return view('post/view')->with('data', $data[0]); 
    });

    Route::middleware('auth:web')->get('post/edit/{id}', function (App\Models\Post $posts, $id) {
        return view('post/edit')->with('data', $posts::find($id));
    });

    /* ---------- Categories ---------- */
    Route::middleware('auth:web')->get('categoria', function () {
        return view('category/list');
    });

    Route::middleware('auth:web')->get('categoria/add', function () {
        return view('category/add');
    });

    Route::middleware('auth:web')->get('categoria/{id}', function (App\Models\Category $categories, $id) {
        return view('category/view')->with('data', $categories::find($id));
    });

    Route::middleware('auth:web')->get('categoria/edit/{id}', function (App\Models\Category $categories, $id) {
        return view('category/edit')->with('data', $categories::find($id));
    });

});
