<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable=[
        'name',
        'address',
        'city',
        'url',
        'logo',
        'phone',
        'vote',
    ];

    public function typologies()
    {
        return $this->belongsToMany(Typology::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // completare la relazione con la tabella restaurateur
}
