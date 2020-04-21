<?php

namespace App\Http\Controllers;

use App\Address;
use App\Order;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders;

        return view('profile.orders', ['orders' => $orders]);
    }

    public function showOrder(Order $order)
    {
        return view('profile.order_show', ['order' => $order]);
    }

    public function address()
    {
        return view('profile.address');
    }

    public function updateAddress(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'address' => 'required|min:7',
        ]);

        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->city_id = 1;
        $address->address = $data['address'];
        $address->phone = 1;
        $address->save();

        return back();
    }


    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'password_current' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if (Hash::check($data['password_current'], Auth::user()->password)){
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return back()->with('message', 'Пароль успешно изменен');

        }


        return back()->with('message', 'Пароль указан неверно');
    }

    public function wishlist(){
        $wl = WishList::all();
        $wishlist = Auth::user()->wishlist;

        return view('profile.wishlist', ['wishlist' => $wishlist]);
    }


}
