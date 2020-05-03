<?php

namespace App\Http\Controllers;

use App\Popular;
use App\Product;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $populars = Popular::latest()->paginate(10);

        return view('admin.popular.index', [
            'populars' => $populars
        ]);
    }

    public function create()
    {
        return view('admin.popular.form', [
            'products' => Product::latest()->paginate(10),
        ]);
    }

    public function addProduct(Request $request)
    {
        $data = $request->validate([
            'products.*' => 'exists:products,id|unique:populars,product_id'
        ]);

        foreach ($data['products'] as $productId){
            $popular = new Popular();
            $popular->product_id = $productId;
            $popular->save();
        }

        return redirect()->route('popular.index')->with('message', 'Товары успешно добавлены');;
    }

    public function deleteProduct(Product $product)
    {
        $popular = $product->popular;
        $popular->delete();
        return back()->with('message', 'Товар удален успешно');
    }

}
