<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiCartController extends Controller
{
    public function index(){
//        $cart = [];

       $products =  \Cart::getContent();

//        $products = \Cart::getContent()->each(function ($item){
//           json_encode($item);
////           dd($cart);
//       });
//        dd($products);
//        dd(json_encode($products));
        $response = ['product' => 2];

//        $cart[] = $products;

        return response()->json(['cart'  => $products]);
    }
}
