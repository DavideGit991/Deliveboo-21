<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'RestaurantController@index')->name('home');
Route::get('/home/dishes/{id}', 'DishController@index')->name('dishes-index');
