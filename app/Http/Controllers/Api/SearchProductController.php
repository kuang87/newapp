<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchProductController extends Controller
{
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['error' => true], 500);
        }
        $text = $request->input('text');
        $products = Product::where('name', 'LIKE', "%$text%")->paginate(10);
        return new ProductCollection($products);
    }
}
