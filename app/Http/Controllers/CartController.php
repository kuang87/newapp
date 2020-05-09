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
}
