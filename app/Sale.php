<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'name', 'description', 'discount', 'type', 'active', 'expired'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
