<?php


Route::post('api/user/login','UserController@post');

Route::get('api/company/info','CompanyController@get');
Route::group(['namespace' => '/Api/Controllers'], function () {
    Route::get('info','ProvinceController@get');
});

Route::post('api/user/login','UserController@post');

Route::get('api/company/info','CompanyController@get');
Route::group(['namespace' => '/Api/Controllers', 'middleware' => ['user.auth','user.login']], function () {
    Route::get('info','ProvinceController@get');
});

Route::post('api/user/login','UserController@post');

Route::get('api/company/info','CompanyController@get');
Route::group(['namespace' => '/Api/Controllers', 'middleware' => ['user.auth']], function () {
    Route::get('info','ProvinceController@get');
});

Route::post('api/user/login','UserController@post');

Route::get('api/company/info','CompanyController@get');
Route::group([ 'middleware' => ['user.auth']], function () {
    Route::get('info','ProvinceController@get');
});