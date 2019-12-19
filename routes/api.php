<?php

Route::group(['middleware' => ['cors', 'api']], function () {


Route::post('/login', 'API\UserController@Login');
Route::post('/exam', 'API\UserController@GenerateExam');
Route::post('/result', 'API\UserController@Result');
Route::post('/cv','API\UserController@createCv');



});
