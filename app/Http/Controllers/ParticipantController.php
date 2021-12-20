<?php

namespace App\Http\Controllers;

use App\MhParticipant;
use App\MhParticipantType;
use Illuminate\Http\Request;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(MhParticipant::class, 'participant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataParticipant = MhParticipant::with("mh_participant_type")
            ->filters(request(["search", "type", "paid_status"]))
            ->paginate(20);

        $participant = new MhParticipant();

        return view(
            'participant.index',
            ['participants' => $dataParticipant]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participant = new MhParticipant();

        $participant->name = old("name");
        $participant->address = old("address");
        $participant->description = old("description");
        $participant->mh_participant_type_id = old("mh_participant_type_id");

        return view(
            'participant.form',
            [
                "participant" => $participant,
                "method" => "POST",
                "action_url" => url('/participant'),
                "participant_types" => MhParticipantType::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "mh_participant_type_id" => 'required',
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'description' => 'required',
            // 'custom_title' => 'required'
        ]);

        $participant = new MhParticipant($request->all());

        $participant->key = md5(date("Hismdyu") . rand());

        if ($request->mh_participant_type_id != 3) {
            $participant->paid_status = 1;
        } else {
            $participant->paid_status = 0;
        }

        $type = MhParticipantType::find($request->mh_participant_type_id);
        $participant->mh_participant_type()->associate($type);

        $participant->save();

        return redirect('/participant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhParticipant $participant)
    {
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        ]);

        return view(
            'participant.detail',
            [
                'participant' => $participant,
                'qrcode' => new QRCode($options)
            ]
        );
    }

    public function printIdcard(Request $request, MhParticipant $participant)
    {
        if (!$this->authorize("update", $participant)) {
            abort(403);
        }

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


        return view(
            'participant.id_print_single',
            [
                'participant' => $participant,
                'qrcode' => new QRCode($options),
                'align' => $align
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhParticipant $participant)
    {
        return view(
            'participant.form',
            [
                "participant" => $participant,
                "method" => "PUT",
                "action_url" => url('/participant/' . $participant->id),
                "participant_types" => MhParticipantType::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MhParticipant $participant)
    {
        $validatedData = $request->validate([
            "mh_participant_type_id" => 'required',
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'description' => 'required',
            // 'custom_title' => 'required'
        ]);

        $participant->name = $request->name;
        $participant->address = $request->address;
        $participant->contact = $request->contact;
        $participant->description = $request->description;
        $participant->key = md5(date("Hismdyu") . rand());

        if ($participant->mh_participant_type->id != 3 || $participant->paid_status == 1) {
            $participant->paid_status = 1;
        } else {
            $participant->paid_status = 0;
        }

        // tipe participant sudah tidak bisa di edit;
        // $participant->mh_participant_type()->associate($type);

        $participant->save();

        return redirect('/participant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhParticipant $participant)
    {
        $participant->delete();
        return redirect('/participant');
    }
}
