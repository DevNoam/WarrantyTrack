<?php

// Home:
    //GET
$router->get('/', 'HomeController@index');
$router->get('/archive', 'HomeController@archive');
$router->forward('/post', '/archive');
$router->forward('/posts', '/archive');
$router->get('/post/{postId}', 'HomeController@fetchPost');
$router->get('/thanks', 'HomeController@thanks');


//Management:
    //GET
$router->get('/management', 'PostController@showManagement', ['admin']);
$router->get('/postWriter', 'PostController@loadPostEditor', ['admin']);
$router->get('/postWriter/{postId}', 'PostController@loadPostEditor', ['admin']);

    //POST
$router->post('/postWriter', 'PostController@makePost', ['admin']);
$router->put('/postWriter/{postId}', 'PostController@updatePost', ['admin']);
$router->delete('/postWriter/{postId}', 'PostController@purgePost', ['admin']);
$router->post('/management/sticky', 'PostController@makeSticky');
$router->post('/management/visibility', 'PostController@changeVisibility');
    
    
//Authentication:
    //GET
$router->get('/authenticate', 'UserController@showAuthentication');
$router->post('/logout', 'UserController@logout', ['admin']);
    //POST
$router->post('/authenticate', 'UserController@authMaker');


//Public API:
    //GET
$router->forward('/api', '/api/v1'); //Forward to relevant API version
$router->get('/api/v1', 'PublicAPI@APIList'); //Get API list
$router->get('/api/v1/{id}', 'PublicAPI@RequestHandler'); //Fetch the API based on params