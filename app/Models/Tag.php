<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    public function purchases()
    {
        return $this->belongsToMany('App\Models\Purchase', 'purchase_tags', 'tag_id', 'purchase_id');
    }

}
