<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Order extends Model
{

    protected $fillable = [
        'status',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'total');
    }

    public function status()
    {
        return DB::table('order_status')->where('id', $this->status)->first();
    }
}
