<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;


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

    public function clear(){
        \Cart::clear();
        return response()->json(['clear' => true]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $products =  \Cart::getContent();
        if ($products->contains('id', $product->id)){
            \Cart::update($product->id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $data['quantity']),
                )
            );
            return response()->json(['update' => true]);
        }
        else{
            return response()->json(['error' => true], 500);
        }
    }

    public function addItem(Product $product)
    {
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => empty($product->spl_price) ? $product->price : $product->spl_price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ]
        ));

        $cartProduct = \Cart::get($product->id);

        return response()->json(['product' => $cartProduct]);
    }
}
