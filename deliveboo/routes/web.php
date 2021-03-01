<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'RestaurantController@index')->name('home');
Route::get('/home/restaurant/{id}/dishes', 'DishController@index')->name('dishes-index');
Route::post('/home/dish/store', 'DishController@store')->name('dish-store');
