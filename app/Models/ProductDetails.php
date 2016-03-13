<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';

    protected $fillable = ['shop_id', 'product_id', 'single_price', 'used_at'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }

}
