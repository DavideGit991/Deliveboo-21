<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\Restaurant;
use GuzzleHttp\Psr7\LimitStream;
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

         //         SELECT orders.id as 'ordine' ,dishes.id as 'piatto',restaurants.id as 'restaurant'
         // FROM restaurants
         //     join dishes on dishes.restaurant_id=restaurants.id
         //     join dish_order on dish_order.dish_id=dishes.id
         //     join orders on orders.id= dish_order.order_id
         // WHERE restaurants.id=5
         // ORDER BY `ordine` DESC


        $orders=DB::table('restaurants')

          ->select('orders.id as ordine','orders.name as uname','orders.lastname','orders.address','orders.phone'
                ,'dishes.name','orders.tot_price')

          ->join('dishes','dishes.restaurant_id','=','restaurants.id')
          ->join('dish_order','dishes.id','=','dish_order.dish_id')
          ->join('orders','orders.id','=','dish_order.order_id')
          ->where('restaurants.id','=',$id)
          ->orderBy('orders.id','desc')
          ->get();



         return response()->json($orders);
     }


}
