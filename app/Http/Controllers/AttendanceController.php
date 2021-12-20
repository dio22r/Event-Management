<?php

namespace App\Http\Controllers;

use App\MhEvent;
use App\MhParticipant;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
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

        MhEvent::where("key", "=", $keyEvent)->firstOrFail();

        $participant = MhParticipant::whereHas('mh_events', function ($query) use ($keyEvent) {
            $query->where("mh_events.key", "=", $keyEvent);
        });

        $arrRespond = [
            "data" => $participant->get(),
            "total" => 0,
        ];

        return $arrRespond;
    }
}
