<?php

use Matrix\Route;

Route::get('/', 'IndexController@index');

Route::get('/news', 'NewsController@index');
Route::post('/news', 'NewsController@store');

Route::get('/news/list', 'NewsController@list');
Route::get('/news/create', 'NewsController@create');

Route::get('/news/id/{id}', 'NewsController@show');