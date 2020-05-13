<?php

namespace App\Http\Controllers;

use App\Category;
use App\Popular;
use App\Product;
use App\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $favorites = Product::where('favorites', 1)->first();
        $saleProducts = Product::where('spl_price', '!=', '')->inRandomOrder()->take(3)->get();
        $populars = Popular::all();
        $popularCategories = DB::table('populars')
                                ->join('products', 'populars.product_id', '=', 'products.id')
                                ->select('category_id')
                                ->groupBy('category_id')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->select(['categories.id', 'categories.name'])
                                ->get();

        return view('front.home', [
            'favorites' => $favorites,
            'saleProducts' => $saleProducts,
            'populars' => $populars,
            'popularCategories' => $popularCategories,
        ]);
    }

    public function shop()
    {
        $products = Product::paginate(6);
        return view('front.shop', [
            'products' => $products,
        ]);
    }

    public function details(Product $product)
    {
        return view('front.product_details', ['product' => $product]);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function category(Category $category)
    {
        $products = $category->products()->paginate(6);

        return view('front.shop', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function addToWishlist(Product $product)
    {
        $wishList = new WishList();
        $wishList->user_id = Auth::user()->id;
        $wishList->product_id = $product->id;
        $wishList->save();

        return view('front.product_details', ['product' => $product]);
    }

}
