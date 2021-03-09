<?php
namespace App\Http\Controllers;
use App\Restaurant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        return view('pages.home',compact('restaurant'));
    }
    public function create()
    {
        return view('pages.restaurant-create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        Validator::make($data,[          //validazione
            'name'=>'required|max:40',
            'address'=>'required',
            'city'=>'required',
            'phone'=>'required',
        ])-> validate();
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
        Validator::make($data,[          //validazione
            'name'=>'required|max:40',
            'address'=>'required',
            'city'=>'required',
            'phone'=>'required',
        ])-> validate();
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
        $cities=DB::table('restaurants')-> select('city')->distinct()-> get();
        return response()-> json($cities);
    }
    public function getRestaurantCity(Request $request)
    {
        $city=$request-> all();
        $restaurants=DB::table('restaurants')
        ->where('city','=',$city)-> get();

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
            ->get();
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

    public function getStats($id)
    {
    //     SELECT orders.month,COUNT(orders.month),restaurants.id, restaurants.name
    // FROM restaurants
    //     JOIN dishes ON dishes.restaurant_id=restaurants.id
    //     JOIN dish_order on dishes.id=dish_order.dish_id
    //     JOIN orders on orders.id =dish_order.order_id
    //    WHERE restaurants.id=1
    //    GROUP BY orders.month
    $restaurant=Restaurant::findOrFail($id);

    $stats=DB::table('restaurants')
    ->select( DB::raw('orders.month, count(orders.month) as ordineMese'))
        ->join('dishes','dishes.restaurant_id', '=', 'restaurants.id')
        ->join('dish_order','dishes.id','=','dish_order.dish_id')
        ->join('orders','orders.id','=','dish_order.order_id')
        ->where('restaurants.id','=',$id)
        ->groupBy('orders.month')
        ->get();
        return view('pages.stats', compact('stats','restaurant'));
    }
}
