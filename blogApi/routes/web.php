<?php



//Categorias
$router->group(['prefix'=>'categorias'],function() use ($router){

    $router->get('/','CategoriaController@index');
    $router->get('/{id}','CategoriaController@show');
        
});
    
//Postagens
$router->group(['prefix'=>'postagens'],function() use ($router){

    $router->get('/', 'PostagemController@index');
    $router->get('/{id}', 'PostagemController@show');

    $router->post('/', 'PostagemController@store');
    $router->put('/{id}', 'PostagemController@update');

    $router->delete('/{id}', 'PostagemController@delete');
});

