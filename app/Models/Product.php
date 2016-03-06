<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function details()
    {
        return $this->hasMany('App\Models\ProductDetails');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category');
    }

    public function purchasings()
    {
        return $this->belongsToMany('App\Models\Offer', 'purchase_product');
    }
}
