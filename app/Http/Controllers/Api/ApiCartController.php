<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;


class ApiCartController extends Controller
{
    public function index(){
       $products =  \Cart::getContent();

       return response()->json(['cart'  => $products]);
    }

     public function remove(Product $product){
         $products =  \Cart::getContent();
         if ($products->contains('id', $product->id)){
             \Cart::remove($product->id);
            return response()->json(['remove' => true]);
         }
         else{
             return response()->json(['error' => true], 500);
         }
     }
}
