<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('active', 'desc')->orderBy('expired', 'asc')->latest()->paginate(10);

        return view('admin.sale.index', [
            'sales' => $sales,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sale.form',[

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'discount' => 'required|integer|min:0',
            'type' => 'required|in:cost,percent',
            'expired' => 'required|date|after:today',
        ]);

        $sale = new Sale();

        if ($request['active']){
            $sale->active = 1;
        }

        if ($data['type'] === 'percent' && $data['discount'] >= 100){
            return back()->withErrors(['error' => 'Discount cannot be more than 100%']);
        }

        $sale->name = $data['name'];
        $sale->description = $data['description'];
        $sale->discount = $data['discount'];
        $sale->type = $data['type'];
        $sale->expired = $data['expired'];

        $sale->save();

        return redirect()->route('sales.index')->with('message', 'Акция создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('admin.sale.show', [
            'sale' => $sale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        return view('admin.sale.form', [
            'sale' => $sale
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'discount' => 'required|integer|min:0',
            'type' => 'required|in:cost,percent',
            'expired' => 'required|date|after:today',
        ]);

        if ($request['active']){

            $currentSaleCollection = $sale->products()->get();
            if ($currentSaleCollection->isNotEmpty()){
                $activeSales = Sale::where('active', 1)
                    ->where('id', '!=', $sale->id)
                    ->get();

                foreach ($activeSales as $activeSale){
                    $activeSaleCollection = $activeSale->products()->get();

                    $diff = $currentSaleCollection->diff($activeSaleCollection);

                    if ($diff->count() !== $currentSaleCollection->count()){
                        return back()->withErrors(['error' => 'Товары из акции участвуют в другой активной акции. Удалите товары из акции.']);
                    }
                }
            }
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }

        if ($data['type'] === 'percent' && $data['discount'] >= 100){
            return back()->withErrors(['error' => 'Discount cannot be more than 100%']);
        }

        $sale->update($data);

        return redirect()->route('sales.index')->with('message', 'Акция отредактирована');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        foreach ($sale->products as $product){
            $product->update([
                'spl_price' => '',
            ]);
        }
        $sale->products()->sync([]);
        $sale->delete();
        return redirect()->route('sales.index')->with('message', 'Акция удалена');
    }
}
