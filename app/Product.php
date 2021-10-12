<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $guard = ["id", "created_at", "update_at", "deleted_at"];

    use SoftDeletes;

    public function formatPrice()
    {
        return "Rp. " . number_format($this->price, 0) . " ,-";
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
