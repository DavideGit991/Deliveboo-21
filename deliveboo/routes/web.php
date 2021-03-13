<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    $restaurant=Restaurant::all();
    return view('pages.main-home',compact('restaurant'));
})->name('main');

Auth::routes();

// rotte ristorante
Route::get('/home', 'RestaurantController@index')->name('home');

Route::get('/create', 'RestaurantController@create')->name('restaurant-create');
Route::post('/store', 'RestaurantController@store')->name('restaurant-store');

Route::get('/edit/{id}', 'RestaurantController@edit')->name('restaurant-edit');
Route::post('/update/{id}', 'RestaurantController@update')->name('restaurant-update');

Route::get('/destroy/{id}', 'RestaurantController@destroy')->name('restaurant-destroy');

// img ristorante
Route::post('/upload', 'RestaurantController@upload')
    ->name('upload');
Route::get('/delete/avatar', 'RestaurantController@deleteDb')
    ->name('delete-avatar');


// Rotte Piatti
Route::get('/home/restaurant/{id}/dishes', 'DishController@index')->name('dishes-index');
Route::get('/home/restaurant/{id}/dish/create', 'DishController@create')->name('dish-create');

Route::post('/home/dish/store', 'DishController@store')->name('dish-store');
Route::get('/home/dish/edit/{id}', 'DishController@edit')->name('dish-edit');
Route::post('/home/dish/update/{id}', 'DishController@update')->name('dish-update');
Route::get('/home/dish/delete/{id}', 'DishController@delete')->name('dish-delete');

//restituisce pagina menu per il ristorante
Route::get('/show/restaurant/menu/{id}', 'DishController@showMenu') ->name('show-menu');

//piatti per menu singolo ristornate
Route::get('/dishes/{id}', 'DishController@getDishes');

//pagamento
Route::post('/payment', 'OrderController@payment');

//stats
Route::get('/stats/{id}','RestaurantController@getstats')->name('stats');

//ordini del ristorante
Route::get('/orders/{id}','OrderController@getOrders')->name('get-orders');
// ultimo ordine
Route::get('/lastorder/{id}','OrderController@getLastOrder')->name('get-lastorder');


// ApiController
Route::post('/typologiesCity', 'ApiController@getTypologiesCity')-> name('get-typologyCity');
Route::get('/cities', 'ApiController@getCity')-> name('get-city');
Route::post('/restaurantCity', 'ApiController@getrestaurantCity')-> name('get-restaurant-city');
    //ristoranti piu' votati
Route::get('/votes', 'ApiController@getRestaurantVotes');
    //ricerca ristoranti per nome
Route::post('/search','ApiController@searchRestaurant');
    //restituisce ristoranti della cita per tipologia
Route::post('/selectedTypology','ApiController@getRestaurantTypologies');
