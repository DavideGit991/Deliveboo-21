<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Restaurant;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index($id)
    {   
        $restaurantId= Restaurant::findOrFail($id);
        $dishes=Dish::where('restaurant_id', $id)->orderBy('id','desc')->get();     //recuper solo i piatti con id_restaurant del ristoratore loggato
        return view('dishes-index', compact('dishes', 'restaurantId'));
    }

    public function store(Request $request)
    {
        $data=$request-> all();
        // $idRest=$request
        $dish = Dish::make($request -> all());      
        $restaurant = Restaurant::findOrFail($data['restaurant_id']);    //recupero id del ristorante del ristoratore loggato
        $dish -> restaurant() -> associate($restaurant);
        $dish -> save();
        return redirect() -> route('dishes-index', $restaurant-> id);
    }

    public function edit(Dish $dish)
    {
        //
    }

    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
