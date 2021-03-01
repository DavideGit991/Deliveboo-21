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
        $dishes=Dish::where('restaurant_id', $id)->get();
        return view('dishes-index', compact('dishes', 'restaurantId'));
    }

    public function create(Request $request)
    {
        $dish=Dish::create($request -> all());
        return response()-> json($dish, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Dish $dish)
    {
        //
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
