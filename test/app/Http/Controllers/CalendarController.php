<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AppointmentsResource;
use App\Models\Appointments;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AppointmentsResource::collection(Appointments::all());
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->end = date('Y-m-d', strtotime("$request->start"));
        $request->endTime = date('H:i:s', strtotime("$request->startTime + 30 minutes"));
        $new_event = new Appointments([
            'title' => $request->input('title'),
            'doc_id' => $request->input('doc_id'),
            'start' => date('Y-m-d H:i:s', strtotime("$request->start $request->startTime")),
            'end' => date('Y-m-d H:i:s', strtotime("$request->end $request->endTime"))
        ]);
        $new_event->save();
        return response()->json([
            'data' => new AppointmentsResource($new_event),
            'message' => 'Successfully added new event !',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return AppointmentsResource::collection(Appointments::where('doc_id', $id)->get());
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
        $update = Appointments::find($id);
        $request->end = date('Y-m-d', strtotime("$request->start"));
        $request->endTime = date('H:i:s', strtotime("$request->startTime + 30 minutes"));
        $update->title = $request->input('title');
        $update->start = date('Y-m-d H:i:s', strtotime("$request->start $request->startTime"));
        $update->end = date('Y-m-d H:i:s', strtotime("$request->end $request->endTime"));
        $update->save();
        return response()->json([
            'data' => new AppointmentsResource($request),
            'message' => 'Successfully updated event!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Appointments::find($id);
        $delete->delete();
        return response('Event removed successfully!');
    }
}
