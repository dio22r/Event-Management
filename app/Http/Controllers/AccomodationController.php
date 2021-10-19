<?php

namespace App\Http\Controllers;

use App\MhParticipant;
use App\ThAccomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accomodations = ThAccomodation::with("mh_participants")->get();

        return view(
            'accomodation.index',
            ['accomodations' => $accomodations]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $accomodation = new ThAccomodation();

        $selParticipants = [];
        $participants = MhParticipant::doesntHave("th_accomodations")->where("paid_status", "=", 1);

        $reqMhParticipantId = $request->mh_participant_id;
        if ($request->hapus) {
            foreach ($reqMhParticipantId as $key => $id) {
                if ($id == $request->hapus) {
                    unset($reqMhParticipantId[$key]);
                }
            }
        }

        $reqMhParticipantId = array_filter($reqMhParticipantId ?? []);
        if ($reqMhParticipantId) {
            $selParticipants = MhParticipant::whereIn("id", $reqMhParticipantId)
                ->where("paid_status", "=", 1)
                ->get();


            $participants->whereNotIn("id", $reqMhParticipantId);
        }

        $accomodation->location = old("location");
        $accomodation->room = old("room");

        return view(
            'accomodation.form',
            [
                "accomodation" => $accomodation,
                "method" => "POST",
                "action_url" => url('/accomodation'),
                "participants" => $participants->get(),
                "selParticipants" => $selParticipants
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
            "mh_participant_id" => 'required',
            'location' => 'required',
            'room' => 'required',
        ]);

        $accomodation = new ThAccomodation($request->all());
        $accomodation->user_id = Auth::user()->id;
        $accomodation->save();
        $accomodation->mh_participants()->attach($request->mh_participant_id);

        return redirect('/accomodation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ThAccomodation $accomodation)
    {
        return view(
            'accomodation.detail',
            ['accomodation' => $accomodation]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThAccomodation $accomodation)
    {
        $accomodation->delete();

        return redirect("/accomodation");
    }
}
