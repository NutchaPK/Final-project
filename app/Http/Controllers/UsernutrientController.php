<?php

namespace App\Http\Controllers;

use App\Models\Usernutrient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsernutrientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'calories'=>'required|between:0,99.99',
            'protein'=>'required|between:0,99.99',
            'potassium'=>'required|between:0,99.99',
            'phosphorus'=>'required|between:0,99.99',
            'sodium'=>'required|between:0,99.99',
        ]);

        
        $un = new Usernutrient([
            'user_id'=> Auth::id(),
            'calories'=> $request->calories,
            'protein'=>$request->protein,
            'potassium'=>$request->potassium,
            'phosphorus'=>$request->phosphorus,
            'sodium'=>$request->sodium,
        ]);
        $un->save();

        $usernutrient = Usernutrient::where('user_id',Auth::id())->orderByDESC('id')->first();
        return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ")->with(compact('usernutrient'));
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
