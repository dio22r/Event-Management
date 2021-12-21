<?php

namespace App\Http\Controllers;

use App\MhEvent;
use App\MhParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function all($key)
    {
        $keyEvent = $key;

        $event = MhEvent::where("key", "=", $keyEvent)->firstOrFail();

        $data = MhParticipant::join('th_attendances', 'mh_participant_id', '=', 'mh_participants.id')
            ->join('mh_events', 'mh_event_id', '=', 'mh_events.id')
            ->select('mh_participants.id', 'mh_participants.name', 'mh_participants.address', 'mh_participants.mh_participant_type_id', DB::RAW('MIN(th_attendances.created_at) as time_log'))
            ->where('mh_events.key', '=', $keyEvent)
            ->groupBy('mh_participants.id', 'mh_participants.name', 'mh_participants.address', 'mh_participants.mh_participant_type_id')
            ->orderBy('time_log', 'ASC')
            ->paginate(20);


        return view("attendance.all", [
            "event" => $event,
            "participants" => $data
        ]);
    }

    public function show($key)
    {
        $event = MhEvent::where("key", "=", $key)->firstOrFail();

        return view("attendance.show", [
            "event" => $event,
            "jsIntialValue" => [
                "keyEvent" => $key,
                "urlPost" => route('attendance.store'),
                "urlGet" => route('attendance.list'),
            ]
        ]);
    }

    public function store(Request $request)
    {
        $keyEvent = $request->key_event;
        $keyParticipant = $request->key;

        $event = MhEvent::where("key", "=", $keyEvent)
            ->where("is_open", "=", "1")
            ->firstOrFail();

        $participant = MhParticipant::where("key", "=", $keyParticipant)
            ->where("paid_status", "=", 1)
            ->firstOrFail();

        $event->mh_participants()->attach($participant);

        return [
            "status" => "Oke!",
            "msg" => "Selamat Datang " . $participant->name
        ];
    }

    public function list(Request $request)
    {
        $keyEvent = $request->key_event;

        $event = MhEvent::where("key", "=", $keyEvent)->firstOrFail();

        $data = MhParticipant::join('th_attendances', 'mh_participant_id', '=', 'mh_participants.id')
            ->join('mh_events', 'mh_event_id', '=', 'mh_events.id')
            ->select('mh_participants.id', 'mh_participants.name', 'mh_participants.mh_participant_type_id', DB::RAW('MAX(th_attendances.created_at) as time_log'))
            ->where('mh_events.key', '=', $keyEvent)
            ->groupBy('mh_participants.id', 'mh_participants.name', 'mh_participants.mh_participant_type_id')
            ->orderBy('time_log', 'DESC')
            ->limit(15)
            ->get();

        $arrRespond = [
            "data" => $data,
            "total" => 0,
        ];

        return $arrRespond;
    }
}
