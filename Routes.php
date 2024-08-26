<?php

// Home:
    //GET
$router->get('/', 'HomeController@panel', ['user']);
$router->get('/cases', 'HomeController@cases', ['user']);
$router->get('/reports', 'HomeController@reports' , ['user']);
$router->get('/search', 'HomeController@searchCase', ['user']);
$router->get('/settings', 'SettingsController@showSettings', ['Admin']); //Admins only /////1
// $router->get('/', 'HomeController@trackInquiry' ['guest']); //Track inquiry page
$router->get('/users', 'UserController@showUsers', ['Admin']);
$router->get('/profile', 'UserController@profile', ['user']);
$router->get('/createuser', 'UserController@createUser', ['Admin']);
$router->get('/printCase', 'inquiryController@printInquiry', ['User']);


//Authentication:
    //GET
$router->get('/authenticate', 'UserController@showAuthentication', ['guest']);
//POST
$router->post('/authenticate', 'UserController@authMaker', ['guest']);
$router->post('/logout', 'UserController@logOut', ['user']);