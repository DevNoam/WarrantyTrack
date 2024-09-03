<?php

// Home:
    //GET
$router->get('/', 'HomeController@panel', ['user']);
$router->get('/cases', 'HomeController@cases', ['user']);
$router->get('/reports', 'HomeController@reports' , ['user']);
$router->get('/search/{query}', 'HomeController@searchCase', ['user']);
$router->get('/printCase{id}', 'inquiryController@printInquiry', ['User']);
$router->get('/profile', 'UserController@profile', ['user']);
$router->get('/profile/{id}', 'UserController@profile', ['Admin']);
$router->get('/settings', 'SettingsController@showSettings', ['Admin']); //Admins only /////1
$router->get('/users', 'UserController@showUsers', ['Admin']);
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
$router->post('/API/changePassword', 'UserController@changePassword', ['Admin']);
$router->post('/API/timeToDeleteOldCases', 'SettingsController@updateTimetoDeleteCases', ['Admin']);
$router->post('/API/updateStore', 'SettingsController@updateStore', ['Admin']);


$router->post('/API/createCase', 'UserController@1', ['User']);
$router->put('/API/updateCase', 'UserController@1', ['User']);