<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $sales = Sale::where('active', 1)->get();
        return view('admin.product.index', [
            'products' => Product::latest()->paginate(10),
            'sales' => $sales,
        ]);
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

    public function addToFavorites(Product $product)
    {
        $product->update([
            'favorites' => 1,
        ]);
        return back();
    }

    public function removeFromFavorites(Product $product)
    {
        $product->update([
            'favorites' => 0,
        ]);
        return back();
    }

    public function addToSale(Request $request, Product $product)
    {
        $data = $request->validate([
            'sale' => 'required|exists:App\Sale,id',
        ]);

        try{
            $sale = Sale::find($data['sale']);

            if ($product->sales()->where('active', 1)->get()->isNotEmpty()){
                throw new \Exception('Товар уже участвует в акции');
            }

            if ($sale->type === 'percent'){
                $product->update([
                    'spl_price' => $product->price * (100 - $sale->discount) / 100,
                ]);
            }
            elseif(($product->price - $sale->discount) <= 1){
                    throw new \Exception('Стоимость товара не может быть меньше скидки. Выберите другой товар');
            }
            else{
                $product->update([
                    'spl_price' => $product->price - $sale->discount,
                ]);
            }

            $product->sales()->attach($data['sale']);

        }catch (\Exception $exception){
            if ($exception->getCode() == 23000){
                $errorMsg = 'Товар уже присутствует в этой акции';
            }
            else{
                $errorMsg = $exception->getMessage();
            }

            return back()->withErrors(['error'=> $errorMsg]);
        }

        return back()->with('message', 'Товар добавлен в акцию');
    }

    public function removeFromSale(Sale $sale, Product $product)
    {
        $product->update([
            'spl_price' => '',
        ]);
        $sale->products()->detach($product->id);
        return back()->with('message', 'Товар удален из акции');
    }
}
