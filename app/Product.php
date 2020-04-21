<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'code', 'price', 'image', 'info', 'spl_price', 'stock', 'category_id', 'discount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
