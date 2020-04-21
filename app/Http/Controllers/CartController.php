<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $condition;

    public function __construct()
    {
        $this->condition = new CartCondition([
            'name' => 'Delivery',
            'type' => 'delivery',
            'target' => 'total',
            'value' => '+500',
            'order' => 1
        ]);
    }

    public function index()
    {
        return view('cart.index');
    }

    public function condition(CartCondition $condition){
        if (\Cart::getSubTotal() < 1000){
            \Cart::condition($condition);
        }
        else{
            \Cart::removeCartCondition($condition->getName());
        }
    }

    public function addItem(Product $product)
    {
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ]
        ));

        $this->condition($this->condition);

        return back();
    }

    public function destroy(Product $product)
    {
        \Cart::remove($product->id);

        $this->condition($this->condition);

        return back();
    }

    public function clear()
    {
        \Cart::clear();
        \Cart::removeCartCondition($this->condition->getName());
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'pro_qty' => 'between:0,999',
        ]);

        $data = $request->post();

        for ($i=0; $i < count($data['product']); $i++) {
            \Cart::update($data['product'][$i], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => intval($data['pro_qty'][$i]),
                ),
            ));
        }

        $this->condition($this->condition);

        return back();
    }

}
