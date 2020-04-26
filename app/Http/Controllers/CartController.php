<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('cart.index');
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

        return back();
    }

//    public function destroy(Product $product)
//    {
//        \Cart::remove($product->id);
//
//        return back();
//    }

//    public function clear()
//    {
//        \Cart::clear();
//        return back();
//    }

//    public function update(Request $request)
//    {
//        $request->validate([
//            'pro_qty' => 'between:0,999',
//        ]);
//
//        $data = $request->post();
//
//        for ($i=0; $i < count($data['product']); $i++) {
//            \Cart::update($data['product'][$i], array(
//                'quantity' => array(
//                    'relative' => false,
//                    'value' => intval($data['pro_qty'][$i]),
//                ),
//            ));
//        }
//
//        return back();
//    }

}
