<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealNutrient;
use App\Models\Menunutrient;
use App\Models\Userinformation;
use App\Models\Usernutrient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Location as ReflectionLocation;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * return \Illuminate\Contracts\Support\Renderable
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {


        $user_id = Auth::id();
        $menus = Menunutrient::all();
        $meals = Meal::whereDate('created_at', Carbon::today())->get();

        /*For Today Meal Progress bar */
        $calories = 0.0;
        $protein = 0.0;
        $potassium = 0.0;
        $phosphorus = 0.0;
        $sodium = 0.0;
        foreach ($meals as $r) {
            $menu = Menunutrient::where('id', $r->menu_id)->first();

            $calories += $menu->calories;
            $protein += $menu->protein;
            $potassium += $menu->potassium;
            $phosphorus += $menu->phosphorus;
            $sodium += $menu->sodium;
        }
        $userinf = Userinformation::where('user_id', $user_id)->orderByDesc('id')->first();
        if ($userinf->count() == 0) {
            return view('profile');
        } else {
            if (Usernutrient::where('user_id', $user_id)->count() == 0) {

                $usernutrient = new Usernutrient([
                    'user_id' => $user_id,
                    'calories' => 30 * $userinf->weight,
                    'protein' => 0.8 * $userinf->weight,
                    'potassium' => 3000,
                    'phosphorus' => 1000,
                    'sodium' => 2000
                ]);

                
            } else {
                $usernutrient = Usernutrient::where('user_id', $user_id)->orderByDesc('id')->first();
            }
            
            $sql_for_todaymeal = "select a.created_at as date,a.id as meal_id,b.* from meals as a 
            left join menunutrients as b on a.menu_id = b.id 
            where a.user_id = $user_id and cast(a.created_at as date) = curdate() order by a.id desc";
            //$todaymeal = Meal::where('user_id',$user_id)->whereDate('created_at', Carbon::today())->orderbyDESC('id')->get();
            $todaymeal = DB::select($sql_for_todaymeal);

            /*For Nearby Resturant Panel */
            //$ip = request()->ip(); 
            $ip = '27.145.88.123';
            $location = Location::get($ip);
            
            $lat = $location->latitude;
            $long = $location->longitude;
            $getreq = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $lat . '%2C' . $long . '&radius=1500&keyword=%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%99%E0%B8%AD%E0%B8%B2%E0%B8%AB%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%81%E0%B8%A5%E0%B9%89%E0%B8%89%E0%B8%B1%E0%B8%99&key=AIzaSyCNh9acOa_HA38yGz3dJYdqxMX6SA3OMHA';
            $req = Http::get($getreq);
            $nearby = $req['results'];


            return view('home')
                ->with('calories', $calories)
                ->with('protein', $protein)
                ->with('potassium', $potassium)
                ->with('phosphorus', $phosphorus)
                ->with('sodium', $phosphorus)
                ->with(compact('menus'))
                ->with(compact('todaymeal'))
                ->with(compact('meals'))
                ->with(compact('usernutrient'))
                ->with(compact('nearby'));
        }
    }
}
