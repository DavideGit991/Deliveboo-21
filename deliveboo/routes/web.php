<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('pages.home');
});

Auth::routes();

// rotte ristorante
Route::get('/home', 'RestaurantController@index')->name('home');

Route::get('/create', 'RestaurantController@create')->name('restaurant-create');
Route::post('/store', 'RestaurantController@store')->name('restaurant-store');

Route::get('/edit/{id}', 'RestaurantController@edit')->name('restaurant-edit');
Route::post('/update/{id}', 'RestaurantController@update')->name('restaurant-update');

Route::get('/destroy/{id}', 'RestaurantController@destroy')->name('restaurant-destroy');

// Rotte Piatti
Route::get('/home/restaurant/{id}/dishes', 'DishController@index')->name('dishes-index');
Route::get('/home/restaurant/{id}/dish/create', 'DishController@create')->name('dish-create');

Route::post('/home/dish/store', 'DishController@store')->name('dish-store');
Route::get('/home/dish/edit/{id}', 'DishController@edit')->name('dish-edit');
Route::post('/home/dish/update/{id}', 'DishController@update')->name('dish-update');
Route::get('/home/dish/delete/{id}', 'DishController@delete')->name('dish-delete');

Route::get('/typology', 'TypologyController@getTypology')-> name('get-typology');
Route::get('/cities', 'RestaurantController@getCity')-> name('get-city');
Route::post('/restaurantCity', 'RestaurantController@getrestaurantCity')-> name('get-restaurant-city');