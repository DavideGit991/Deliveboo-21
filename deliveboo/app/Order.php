<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'name',
        'lastname',
        'address',
        'tot_price',
        'month',
        'phone',
        'status',
        'mail'
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
