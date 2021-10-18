<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TdPayment extends Model
{
    /**
     * Get the MhParticipant record associated with the TdPaymentDetail.
     */
    public function mh_participant()
    {
        return $this->hasOne('App\MhParticipant');
    }
}
