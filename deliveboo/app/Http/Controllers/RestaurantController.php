<?php
namespace App\Http\Controllers;
use App\Restaurant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
class RestaurantController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $userid=Auth::user()->id;
        $restaurant= User::find($userid)->restaurant;
        return view('home',compact('restaurant'));
    }
    public function create()
    {
        return view('pages.restaurant-create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $newRestaurant=Restaurant::create($data);
        return redirect()->route('home');
    }
    public function edit($id)
    {
        $restaurant=Restaurant::findOrFail($id);
        return view('pages.restaurant-edit',compact('restaurant'));
    }
    public function update(Request $request, $id)
    {
        $data=$request->all();
        $restaurant=Restaurant::findOrFail($id);
        $restaurant->update($data);
        return redirect('home');
    }
    public function destroy($id)
    {
        $restaurant=Restaurant::findOrFail($id);
        $restaurant->delete();
        return redirect()->route('home');
    }
    public function getCity()
    {
        $cities=DB::table('restaurants')-> select('city')-> get();
        return response()-> json($cities);
    }
    public function getRestaurantCity(Request $request)
    {
        $city=$request-> all();
        $restaurants=DB::table('restaurants')->where('city','=',$city)-> get();
        $idRestaurant=[];
        $idTypologies=[];
        // for ($i=0; $i < count($restaurants); $i++) { 
        //     $id=$restaurants[$i]-> id;
        //     $query=DB::table('restaurant_typology')
        //     -> select('typology_id')
        //     ->where('restaurant_id', '=', $id)
        //     ->get();
        //     $idTypologies[]=$query;
        // }
        
        // $idRestaurant[]=$id;
        // $idRestaurants-> id;
        // $idRestaurant=$restaurants['id'];
        
        return response()-> json($restaurants);
    }
}
