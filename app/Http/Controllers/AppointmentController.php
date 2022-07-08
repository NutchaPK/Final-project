<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointment');
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
        
        
        $request->validate([
            'hospital'=>'required',
            'department'=>'required',
            'doctor'=>'required',
            'note'=>'required',
            'date'=>'required',
        ]);
        
        $app = new Appointment([
            'user_id' => Auth::id(),
            'hospital'=>$request->hospital,
            'department'=>$request->department,
            'doctor'=>$request->doctor,
            'note'=>$request->note,
            'date'=>$request->date,
        ]);
        $app->save();
        
        $sql_for_appointment = "select *,datediff(date,curdate()) as date_diff from appointments where user_id =".Auth::id()." and date >= curdate() order by date_diff asc ";
        $appointment = DB::select($sql_for_appointment);

        return redirect('/home')->with('success','appointment saved')->with(compact('appointment'))
        
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
