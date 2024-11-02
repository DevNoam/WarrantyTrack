<?php

// Home:
    //GET
$router->get('/', 'HomeController@panel', ['user']);
$router->get('/cases', 'HomeController@cases', ['user']);
$router->get('/case', 'inquiryController@initCasePage', ['user']);
$router->get('/case/{id}', 'inquiryController@initCasePage', ['user']);
$router->get('/reports', 'HomeController@reports' , ['user']);
$router->get('/search', 'HomeController@searchCase', ['user']);
$router->get('/printCase/{id}', 'inquiryController@printInquiry', ['user']);
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
$router->post('/API/deleteUser', 'UserController@deleteUser', ['Admin']);
$router->post('/API/updateUser', 'UserController@updateUser', ['Admin']);
$router->post('/API/changePassword', 'UserController@changePassword', ['Admin']);
$router->post('/API/timeToDeleteOldCases', 'SettingsController@updateTimetoDeleteCases', ['Admin']);
$router->post('/API/updateStore', 'SettingsController@updateStore', ['Admin']);

$router->post('/API/updateCase', 'InquiryController@updateCase', ['user']);
$router->post('/API/createCase', 'InquiryController@createCase', ['user']);