<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
//auth
$app->post('auth/login', 'AuthController@postLogin');
$app->get('auth/logout','AuthController@logout');
//operator
$app->get('profile','OpController@profile');
$app->post('password','OpController@password');
$app->get('settings','OpController@settings');
$app->get('users','OpController@users');
$app->post('history','OpController@histroy');

//dummy database
$app->get('userjwt','TestController@userjwt');
$app->post('headerjwt','TestController@headerjwt');
$app->get('testjson','TestController@testjson');

//bsg
$app->post('bsapi/user','BsController@user');
$app->get('bscheckusername/{username}','BsController@username');
