<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $table = 'purchase_product';

    protected $fillable = ['purchase_id', 'product_id', 'amount', 'single_price'];

    public function product()
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase', 'purchase_id');
    }

}
