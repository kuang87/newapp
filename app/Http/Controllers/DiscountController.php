<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function apply(Product $product)
    {
        $product->update([
            'discount' => 'valid',
        ]);
        return back();
    }

    public function cancel(Product $product)
    {
        $product->update([
            'discount' => '',
        ]);
        return back();
    }
}
