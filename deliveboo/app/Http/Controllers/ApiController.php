<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCity()
    {
        $cities=DB::table('restaurants')-> select('city')->distinct()-> get();
        return response()-> json($cities);
    }
    public function getRestaurantCity(Request $request)
    {
        $city=$request-> all();
        $restaurants=DB::table('restaurants')
        ->where('city','=',$city)
        ->where('deleted_at','=',null)-> get();

        return response()-> json($restaurants);
    }
    public function getRestaurantVotes()
    {
        $restaurantsVotes=DB::table('restaurants')
                ->select('restaurants.id','restaurants.name','restaurants.logo','restaurants.vote')
                ->limit(5)
                ->orderBy('vote','desc')
                ->get();
        return response()->json($restaurantsVotes);
    }
    public function getTypologiesCity(Request $req)
    {
        // citta
        $city=$req->all();

        $typologies=DB::table('restaurants')
            ->select('typologies.name')
            ->distinct()
            ->join('restaurant_typology','restaurants.id', '=', 'restaurant_typology.restaurant_id')
            ->join('typologies','restaurant_typology.typology_id','=','typologies.id')
            ->where('restaurants.city','=',$city)
            ->where('deleted_at','=',null)-> get();
        
        // query sql
        // SELECT restaurants.name, restaurant_typology.typology_id, typologies.name
        // FROM restaurants
        // JOIN restaurant_typology ON restaurant_typology.restaurant_id=restaurants.id
        // JOIN typologies on restaurant_typology.typology_id=typologies.id
        // WHERE city='city'
        return response()->json($typologies);
    }
    public function searchRestaurant(Request $req)
    {
        $name=$req->all();

        $restaurant=Restaurant::where('name','=' ,$name)->get();

        return response()->json($restaurant);
    }
    public function getRestaurantTypologies(Request $req)
    {
        $data=$req->all();
        $city=$req->city;
        $typology=$req->name;
        $restaurants=DB::table('restaurants')
        ->select( 'restaurants.id','restaurants.name','restaurants.vote','restaurants.address','restaurants.logo')
            ->join('restaurant_typology','restaurants.id', '=', 'restaurant_typology.restaurant_id')
            ->join('typologies','restaurant_typology.typology_id','=','typologies.id')
            ->where('restaurants.city','=',$city)
            ->where('typologies.name','=',$typology)
            ->where('deleted_at','=',null)
            ->orderBy('restaurants.vote','desc')
            ->get();
        // SELECT restaurants.name, restaurants.address, restaurants.vote
        // FROM restaurants
        // JOIN restaurant_typology ON restaurant_typology.restaurant_id=restaurants.id
        // JOIN typologies on restaurant_typology.typology_id=typologies.id
        // WHERE restaurants.city='monza'AND typologies.name='cinese'
        // ORDER BY restaurants.vote DESC

        return response()->json($restaurants);
    }

}
