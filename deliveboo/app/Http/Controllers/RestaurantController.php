<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use App\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $userid=Auth::user()->id;
        $restaurant= User::find($userid)->restaurant;

        return view('home',compact('restaurant'));
    }

    public function show($id)
    {

    }

    public function create()
    {
        return view('restaurant-create');
    }

    public function store(Request $request)
    {
        $data=$request->all();

        $nRestaurant=Restaurant::create($data);
        return redirect()->route('home');;
    }

    public function edit($id)
    {
        $restaurant=Restaurant::findOrFail($id);

        return view('restaurant-edit',compact('restaurant'));
    }


    public function update(Request $request, $id)
    {
        $data=$request->all();

        $restaurant=Restaurant::findOrFail($id);
        $restaurant->update($data);


        return redirect('home')->with('status', 'Restaurant updated!');



    }


    public function destroy($id)
    {
        $restaurant=Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('home');
    }
}
