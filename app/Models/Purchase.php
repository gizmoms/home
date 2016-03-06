<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchasings';

    protected $fillable = ['shop_id', 'bought_at'];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'purchase_product');
    }
}
