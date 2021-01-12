<?php

use Illuminate\Support\Facades\Route;

Route::post('api/user/login','UserController@post');

Route::get('api/company/info','CompanyController@get');
Route::group([ 'middleware' => ['user.auth']], function () {
    Route::get('info','ProvinceController@get');
});