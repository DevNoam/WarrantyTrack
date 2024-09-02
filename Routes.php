<?php

// Home:
    //GET
$router->get('/', 'HomeController@panel', ['user']);
$router->get('/cases', 'HomeController@cases', ['user']);
$router->get('/reports', 'HomeController@reports' , ['user']);
$router->get('/search/{query}', 'HomeController@searchCase', ['user']);
$router->get('/settings', 'SettingsController@showSettings', ['Admin']); //Admins only /////1
$router->get('/users', 'UserController@showUsers', ['Admin']);
$router->get('/profile', 'UserController@profile', ['user']);
$router->get('/profile/{id}', 'UserController@profile', ['user']);
$router->get('/printCase{id}', 'inquiryController@printInquiry', ['User']);
// $router->get('/customer/caseStatus/{id}', 'HomeController@trackInquiry' ['guest']); //Track inquiry page


//Authentication:
//GET
//Show authentication page
$router->get('/authenticate', 'UserController@showAuthentication', ['guest']);
//POST
//Authenticate user
$router->post('/authenticate', 'UserController@authMaker', ['guest']);
$router->post('/logout', 'UserController@logOut', ['user']);


//API:
$router->post('/API/createuser', 'UserController@makeUser', ['Admin']);
$router->delete('/API/deleteUser/{id}', 'UserController@deleteUser', ['Admin']);
$router->put('/API/updateUser', 'UserController@updateUser', ['Admin']);
$router->put('/API/changePassword', 'UserController@changePassword', ['Admin']);


$router->post('/API/createCase', 'UserController@changePassword', ['Admin']);
$router->put('/API/updateCase', 'UserController@changePassword', ['Admin']);