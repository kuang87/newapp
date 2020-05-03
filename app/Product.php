<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'code', 'price', 'image', 'info', 'spl_price', 'stock', 'category_id', 'favorites'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function currentSales()
    {
        return $this->sales()->where('active', 1)->get();
    }

    public function popular()
    {
        return $this->hasOne(Popular::class);
    }
}
