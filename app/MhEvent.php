<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhEvent extends Model
{
    use SoftDeletes;

    protected $fillable = ["name", "start_at", "location", "description"];
}
