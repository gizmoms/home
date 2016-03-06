<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = ['name', 'address_id'];

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\ProductDetails');
    }

}
