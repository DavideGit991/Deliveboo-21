<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'name',
        'address',
        'city',
        'url',
        'logo',
        'phone',
        'vote',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function typologies()
    {
        return $this->belongsToMany(Typology::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // completare la relazione con la tabella restaurateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
