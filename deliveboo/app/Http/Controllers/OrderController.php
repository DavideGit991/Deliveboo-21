<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

   public function payment(Request $req)
   {
       $data=$req->all();

       $order=Order::make([
           'name'=>$data['name'],
           'lastname'=> $data['lastname'],
           'tot_price'=>$data['tot_price'],
           'month'=>$data['month'],
           'address'=>$data['address'],
           'status'=>$data['status'],
           'phone'=>$data['phone'],
           ]);


        $order->save();

        $idplate=Dish::find($data['id']);

        $order->dishes()->attach($idplate);


       return response()->json($data,200) ;
   }

     public function getOrders($id)
     {
         $restaurant=Restaurant::findOrFail($id);
         //         SELECT orders.id as 'ordine' ,dishes.id as 'piatto',restaurants.id as 'restaurant'
         // FROM restaurants
         //     join dishes on dishes.restaurant_id=restaurants.id
         //     join dish_order on dish_order.dish_id=dishes.id
         //     join orders on orders.id= dish_order.order_id
         // WHERE restaurants.id=5
         // ORDER BY `ordine` DESC
         $orders=DB::table('restaurants')
         ->select('orders.id as ordine' ,'dishes.id as piatto','restaurants.id as restaurant')
         ->join('dishes','dishes.restaurant_id','=','restaurants.id')
         ->join('dish_order','dishes.id','=','dish_order.dish_id')
         ->join('orders','orders.id','=','dish_order.order_id')
         ->where('restaurants.id','=',$restaurant)
         ->orderBy('orders.id','desc')
         ->get();
         return response()->json($orders);
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
