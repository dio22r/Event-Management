<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhParticipant extends Model
{

    use SoftDeletes;

    protected $fillable = ["name", "address", "contact", "description", "custom_title", "key", "paid_status"];
    /**
     * Get the post that owns the mh_participant_type.
     */
    public function mh_participant_type()
    {
        return $this->belongsTo(MhParticipantType::class);
    }

    public function th_payments()
    {
        return $this->belongsToMany('App\ThPayment', "td_payments");
    }

    public function th_accomodations()
    {
        return $this->belongsToMany('App\ThAccomodation', "td_accomodations");
    }

    public function mh_events()
    {
        return $this->belongsToMany(MhEvent::class, "th_attendances")
            ->withPivot(['created_at', 'updated_at'])
            ->orderBy('pivot_created_at', 'desc');
    }

    public function formatStatusLunas()
    {
        $arrStatus = ["Belum Lunas", "Lunas"];
        return $arrStatus[$this->paid_status];
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });

        if (isset($filters["paid_status"])) {
            $query->where("paid_status", "=", $filters["paid_status"]);
        }

        $query->when($filters["type"] ?? false, function ($query, $type) {
            return $query->whereHas("mh_participant_type", function ($query) use ($type) {
                $query->where("id", $type);
            });
        });
    }
}
