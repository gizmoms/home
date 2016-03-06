<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = ['name', 'code'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
