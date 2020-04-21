<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index', ['products' => Product::latest()->get()]);
    }

    public function create()
    {
        return view('admin.product.form',[
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $formInput = $request->except('image');

        $request->validate([
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
            'category_id' => 'required',
            'price' => 'required',
            'info' => 'required',
            'stock' => 'required|integer|min:0',
            'image' => 'image|mimes:png,jpg,jpeg|max:10000',
        ]);

        $image = $request->image;


        if ($image){
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
            $formInput['image'] = $imageName;
        }

        Product::create($formInput);

        return redirect()->route('products.index')->with('message', 'Товар сохранен успешно');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', ['product' => $product]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Товар удален успешно');
    }

    public function edit(Product $product)
    {
        return view('admin.product.form', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $formInput = $request->except('image');

        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id . ',id',
            'code' => 'required|unique:products,code,' . $product->id . ',id',
            'category_id' => 'required',
            'price' => 'required',
            'info' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:10000',
        ]);

        $image = $request->image ?? null;

        if ($image){
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
            $formInput['image'] = $imageName;
        }

        $product->update($formInput);

        return redirect()->route('products.index')->with('message', 'Товар отредактирован успешно');
    }
}
