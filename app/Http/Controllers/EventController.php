<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\MhEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataEvent = MhEvent::orderBy("start_at", "ASC")->get();

        return view(
            'event.index',
            ['events' => $dataEvent]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new MhEvent();

        $event->name = old("name");
        $event->date = old("date");
        $event->time = old("time");
        $event->location = old("location");
        $event->description = old("description");

        return view(
            'event.form',
            [
                "event" => $event,
                "method" => "POST",
                "action_url" => url('/event')
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {

        $event = new MhEvent($request->all());
        $event->start_at = $request->date . " " . $request->time;
        $event->key = md5(rand() . date("umiHsY"));
        $event->save();

        return redirect('/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhEvent $event)
    {
        return view(
            'event.detail',
            [
                'event' => $event
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhEvent $event)
    {
        list($date, $time) = explode(" ", $event->start_at);
        $event->date = $date;
        $event->time = $time;

        return view(
            'event.form',
            [
                "event" => $event,
                "method" => "PUT",
                "action_url" => url('/event/' . $event->id)
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
    public function update(EventRequest $request, MhEvent $event)
    {
        $event->name = $request->name;
        $event->start_at = $request->date . " " . $request->time;
        $event->location = $request->location;
        $event->description = $request->description;
        // $event->key = md5(rand() . date("umiHsY"));

        $event->save();
        return redirect('/event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhEvent $event)
    {
        $event->delete();
        return redirect('/event');
    }
}
