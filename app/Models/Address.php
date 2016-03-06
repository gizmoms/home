<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $guarded = ['id', 'latitude', 'longitude', 'created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }

    public function getStreetNameAttribute()
    {
        return $this->street .' '. $this->streetnumber;
    }
}
