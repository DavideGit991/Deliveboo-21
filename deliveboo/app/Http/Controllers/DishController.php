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

    public function edit($id)
    {
        $dish=Dish::findOrFail($id);
        return view('dish-edit', compact('dish'));
    }

    public function update(Request $request, $id)
    {   
        $dish=Dish::findOrFail($id);
        $dish->update($request -> all());
        return redirect() -> route('dishes-index', $dish-> restaurant_id );
    }

    public function delete(Request $request, $id)
    {
        $dish=Dish::findOrFail($id);
        if ($dish-> availability==1) {
            $dish-> availability=0;
            // dd($dish);
        } else {
            $dish-> availability=1;
        }

        $dish->update($request -> all());
        
        return redirect() -> route('dishes-index', $dish-> restaurant_id );
    }
}
