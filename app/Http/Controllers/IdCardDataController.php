<?php

namespace App\Http\Controllers;

use App\MhEvent;
use App\MhParticipant;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdCardDataController extends Controller
{
    public function showEvents($key)
    {
        $participant = MhParticipant::where("key", "=", $key)->firstOrFail();

        $data = MhEvent::join('th_attendances', 'mh_event_id', '=', 'mh_events.id')
            ->join('mh_participants', 'mh_participant_id', '=', 'mh_participants.id')
            ->select('mh_events.id', 'mh_events.name', 'mh_events.location', 'mh_events.start_at', DB::RAW('MIN(th_attendances.created_at) as time_log'))
            ->where('mh_participants.key', '=', $key)
            ->groupBy('mh_events.id', 'mh_events.name', 'mh_events.location', 'mh_events.start_at')
            ->orderBy('start_at', 'ASC')
            ->paginate(20);

        return view('public.idcard_data.show', [
            "participant" => $participant,
            "events" => $data
        ]);
    }

    public function printIdCard(Request $request, $key)
    {
        $participant = MhParticipant::where("key", "=", $key)->firstOrFail();

        if ($participant->paid_status != 1 && $participant->mh_participant_type_id == 3) {
            abort(403);
        }

        $align = "center";
        if ($request->align == "left") {
            $align = "left";
        } else if ($request->align == "right") {
            $align = "right";
        }

        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        ]);

        return view('participant.id_print_single', [
            'participant' => $participant,
            'qrcode' => new QRCode($options),
            'align' => $align
        ]);
    }
}
