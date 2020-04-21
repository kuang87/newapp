<?php

namespace App\Http\Controllers;

use App\Address;
use App\Mail\OrderCreated;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()){
            return view('front.checkout');
        }
        else{
            return redirect('login');
        }
    }

    public function formValidate(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if (\Cart::getSubTotal() == 0){
            return redirect()->back()->with('cartError', ['Ваша корзина пуста']);
        }

        $request->validate([
            'firstName' => 'required|min:3|max:35',
            'email' => 'email:filter',
            'phone' => 'required',
            'options' => 'required',
            'paymentMethod' => 'required',
        ]);


        if ($data['options'] == 'delivery'){

            $request->validate([
                'city' => 'required|exists:cities,id',
                'address' => 'required',
            ]);

            $address = new Address();
            $address->address = $data['address'];
            $address->city_id = $data['city'];
            $address->user_id = $user->id;
            $address->phone = $data['phone'];

            if (isset($data['save-info'])){
                $user->address()->save($address);
            }
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 1;
        $order->total = \Cart::getTotal();
        $order->address = $address->address ?? 'Самовывоз';
        $order->save();

        $items = \Cart::getContent();
        foreach($items as $item) {
            $order->products()->attach($item->id, ['quantity' => $item->quantity, 'total' => $item->quantity * $item->price]);
        }

        Mail::to($data['email'])->queue(new OrderCreated($user, $order));

        \Cart::clear();
        \Cart::clearCartConditions();

        return redirect('thankyou');
    }
}
