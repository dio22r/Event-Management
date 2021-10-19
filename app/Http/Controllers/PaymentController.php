<?php

namespace App\Http\Controllers;

use App\MhParticipant;
use App\ThPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = ThPayment::with("mh_participants")->get();

        return view(
            'payment.index',
            ['payments' => $payments]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment = new ThPayment();

        $selParticipants = [];
        $participants = MhParticipant::where("paid_status", "=", 0);

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
                ->where("paid_status", "=", 0)
                ->get();


            $participants->whereNotIn("id", $reqMhParticipantId);
        }

        $payment->detail = old("detail");
        $payment->total = old("total");
        $payment->bank = old("bank");
        $payment->account = old("account");

        return view(
            'payment.form',
            [
                "payment" => $payment,
                "method" => "POST",
                "action_url" => url('/payment'),
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
            'detail' => 'required',
            'total' => 'required|numeric',
            "file" => "image|file|max:1024"
            // 'custom_title' => 'required'
        ]);

        $payment = new ThPayment($request->all());
        $payment->type = 1;
        $payment->user_id = Auth::user()->id;

        if ($request->file("file")) {
            $payment->file = $request->file("file")->store("payment");
        }


        $payment->save();

        foreach ($request->mh_participant_id as $id) {
            $payment->mh_participants()->attach($id);

            $participant = MhParticipant::find($id);
            $participant->paid_status = 1;
            $participant->save();
        }


        return redirect('/payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ThPayment $payment)
    {
        return view(
            'payment.detail',
            ['payment' => $payment]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ThPayment $payment)
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
    public function update(Request $request, ThPayment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThPayment $payment)
    {
        $payment->delete();
        foreach ($payment->mh_participants as $participant) {
            $participant->paid_status = 0;
            $participant->save();
        }

        return redirect("/payment");
    }
}
