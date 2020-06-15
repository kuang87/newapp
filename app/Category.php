<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function filterProducts($products){
        $filtered = $products->filter(function ($item, $key){
            return $item->category_id === $this->id;
        });

        return $filtered;
    }
}
