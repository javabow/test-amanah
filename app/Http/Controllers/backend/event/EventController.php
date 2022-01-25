<?php

namespace App\Http\Controllers\backend\event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend_mazer.dashboard.event_table");
    }

    public function testPython()
    {
        echo shell_exec("python " . public_path('hello.py'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getDataId(Request $request)
    {
        $validatedData = $request->validate([
            'edit_id' => ['required', 'numeric'],
        ]);

        if ($haha = Event::whereId($request->edit_id)->get()) {
            return response()->json(array('success' => true, 'data' => $haha), 200);
        } else {
            return response()->json(array('success' => false), 401);
        }
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
            'client' => ['required', 'numeric'],
            'title_event' => ['required'],
            'location' => ['required'],
            'start_event' => ['required', 'date'],
            'end_event' => ['required', 'date'],
        ]);

        $add_event = new Event;
        $add_event->client_id = $request->client;
        $add_event->title = $request->title_event;
        $add_event->location = $request->location;
        $add_event->start_date = $request->start_event;
        $add_event->end_date = $request->end_event;

        if ($add_event->save()) {
            return response()->json(array('success' => true, 'last_insert_id' => $add_event->id), 200);
        } else {
            return response()->json(array('success' => false), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $haha = Event::with(['client' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        // return $haha;
        return Datatables::of($haha)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'client' => ['required', 'numeric'],
            'title_event' => ['required'],
            'location' => ['required'],
            'start_event' => ['required', 'date'],
            'end_event' => ['required', 'date'],
        ]);

        try {
            $up_event = Event::FindOrFail($request->client);

            $up_event->update($request->all());

            return response()->json(array('success' => true, 'last_update_id' => $up_event->id), 200);
        } catch (\Exception $e) {
            return response()->json(array('success' => false), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
