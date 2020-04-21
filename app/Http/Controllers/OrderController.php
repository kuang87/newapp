<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('status', 'desc')->latest()->paginate(10);

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function confirm(Order $order)
    {
        $order->update([
            'status' => 2,
        ]);
        return back();
    }

    public function cancel(Order $order)
    {
        $order->update([
            'status' => 3,
        ]);
        return back();
    }
}
