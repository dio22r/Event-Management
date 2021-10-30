<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThPayment extends Model
{
    use SoftDeletes;

    public $fillable = ["type", "detail", "total", "bank", "account", "file", "user_id"];

    /**
     * Get all of the posts for the country.
     */
    public function mh_participants()
    {
        return $this->belongsToMany('App\MhParticipant', "td_payments");
    }

    public function formatTotal()
    {
        return "Rp. " . number_format($this->total, 0) . " ,-";
    }


    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->whereHas("mh_participants", function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%");
            })->orWhere("detail", "like", "%" . $search . "%");
        });
    }
}
