<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'code'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
