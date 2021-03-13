<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    public function index($id)
    {
        $restaurant= Restaurant::findOrFail($id);
        $dishes=Dish::where('restaurant_id', $id)->orderBy('id','desc')->get();     //recuper solo i piatti con id_restaurant del ristoratore loggato
        return view('pages.dishes-index', compact('dishes', 'restaurant'));
    }

    public function create($id)
    {
        $restaurant= Restaurant::findOrFail($id);
        return view('pages.dish-create', compact('restaurant'));
    }

    public function store(Request $request)
    {
      $data=$request-> all();

      Validator::make($data,[          //validazione
          'name'=>'required|string|min:5|max:60',
          'description'=>'required|min:5',
          'price'=>'required|numeric',
      ])-> validate();
      
      $image = $request->file('iconUser');

      $ext = $image->getClientOriginalExtension();

      $name = rand(100000, 999999) . '_' . time();

      $destFile = $name . '.' . $ext;

      $file = $image->storeAs('dish', $destFile, 'public');

      $dish = Dish::make($request -> all());

      $restaurant = Restaurant::findOrFail($data['restaurant_id']);    //recupero id del ristorante del ristoratore loggato

      $dish -> restaurant() -> associate($restaurant);

      $dish->img = $destFile;

      $dish->save();

      return redirect() -> route('dishes-index', $restaurant->id);
    }

    public function edit($id)
    {
        $dish=Dish::findOrFail($id);
        return view('pages.dish-edit', compact('dish'));
    }

    public function update(Request $request, $id)
    {
      $dish=Dish::findOrFail($id);
      $data=$request-> all();
      Validator::make($data,[          //validazione
          'name'=>'required|string|min:5|max:60',
          'description'=>'required|min:5',
          'price'=>'required|numeric',
      ])-> validate();

      if ($request->has('iconUser')) {

          $fileName = $dish->img;

          $file = storage_path('app/public/dish/' . $fileName);
          File::delete($file);

          $image = $request->file('iconUser');

          $ext = $image->getClientOriginalExtension();

          $name = rand(100000, 999999) . '_' . time();

          $destFile = $name . '.' . $ext;

          $file = $image->storeAs('dish', $destFile, 'public');

          $dish->update(
            [
              'name' => $request->name,
              'price' => $request->price,
              'description' => $request->description,
              'availability' => $request->availability,
              'image' => $destFile,
            ]
          );

          $dish->img = $destFile;

        } else {

          $dish->update(
            [
              'name' => $request->name,
              'price' => $request->price,
              'description' => $request->description,
              'availability' => $request->availability,
            ]
          );
        }

        $dish->save();

        return redirect() -> route('dishes-index', $dish-> restaurant_id );

    }

    public function delete(Request $request, $id)     //lo rendo non disponibile ma esiste ancora nel db
    {
        $dish=Dish::findOrFail($id);
        if ($dish-> availability==1) {
            $dish-> availability=0;
        } else {
            $dish-> availability=1;
        }

        $dish->update($request -> all());

        return redirect() -> route('dishes-index', $dish-> restaurant_id );
    }

    public function showMenu($id)
    {

        $restaurant=Restaurant::findOrFail($id);


        return view('pages.menu', compact('restaurant'));
    }

    public function getDishes($id)
    {

        $dishes=Dish::where('restaurant_id', $id)->get();     //recuper solo i piatti con id_restaurant del ristoratore loggato

        return response()->json($dishes);
    }
}
