<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name", "detail"];

    public function roles()
    {
        return $this->belongsToMany('App\User');
    }
}
