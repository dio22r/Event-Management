<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThAccomodation extends Model
{
    use SoftDeletes;

    protected $fillable = ["location", "room", "check_in", "check_out"];

    /**
     * Get all of the participant.
     */
    public function mh_participants()
    {
        return $this->belongsToMany('App\MhParticipant', "td_accomodations");
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->whereHas("mh_participants", function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%");
            })->orWhere("location", "like", "%" . $search . "%")
                ->orWhere("room", "=", $search);
        });
    }
}
