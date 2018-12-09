<?php
use \Col\Route;

Route::any('/', function () {
    return '<h1>In the end, it\'s not the years in your life that count. It\'s the life in your years.</h1>';
});

Route::get('/get', 'LikeController@get');

Route::post('/add', 'LikeController@add');
