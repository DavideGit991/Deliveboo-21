<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    protected $fillable=[
        'name',
        'description',
    ];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
