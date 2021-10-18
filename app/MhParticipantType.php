<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MhParticipantType extends Model
{
    /**
     * Get the post that owns the mh_participant_type.
     */
    public function mh_participants()
    {
        return $this->hasMany(MhParticipant::class, "id", "mh_participant_type_id");
    }
}
