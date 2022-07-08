<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Menunutrient;
use App\Models\Usernutrient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MealController extends Controller
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
            'menu_id'=>'required',
        ]);
        $meal = new Meal([
            'user_id' => Auth::user()->id,
            'menu_id'=>$request->get('menu_id')
        ]);
        $meal->save();

        $meals = Meal::whereDate('created_at',Carbon::today())->get();
        $calories = 0.0;
        $protein = 0.0;
        $potassium = 0.0;
        $phosphorus = 0.0;
        $sodium = 0.0;
        foreach($meals as $r){
            $menu = Menunutrient::where('id',$r->menu_id)->first();

            $calories += $menu->calories;
            $protein += $menu->protien;
            $potassium += $menu->potassium;
            $phosphorus += $menu->phosphorus;
            $sodium += $menu->sodium;
        }

        $usernutrient = Usernutrient::where('user_id',Auth::id())->orderByDesc('id')->first();
        $sql_for_todaymeal = "select a.created_at as date,a.id as meal_id,b.* from meals as a 
            left join menunutrients as b on a.menu_id = b.id 
            where a.user_id = ".Auth::id()." and cast(a.created_at as date) = curdate() order by a.id desc";
            
            $todaymeal = DB::select($sql_for_todaymeal);
        return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ")->with('calories',$calories)
        ->with('protein',$protein)
        ->with('potassium',$potassium)
        ->with('phosphorus',$phosphorus)
        ->with('sodium',$phosphorus)
        ->with(compact('todaymeal'))
        ->with(compact('usernutrient')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meals = Meal::where('user_id',$id);
        return $meals;
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
     * @param  \Illuminate\Http\Request  $request
     *
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
        $meals = Meal::find($id);
        $meals->delete();

        $sql_for_todaymeal = "select a.created_at as date,b.* from meals as a 
        left join menunutrients as b on a.menu_id = b.id 
        where a.user_id =". Auth::id()." and cast(a.created_at as date) = curdate() order by a.id desc";
        $todaymeal = DB::select($sql_for_todaymeal);
        return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ")->with(compact('todaymeal'));

    }
}
