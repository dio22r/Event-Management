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
            "event" => $event
        ]);
    }

    public function store(Request $request)
    {
        $keyEvent = $request->keyEvent;
        $keyParticipant = $request->keyParticipant;

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
}
