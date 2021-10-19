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
}
