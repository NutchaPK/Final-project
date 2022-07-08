<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Meal;
use app\Models\Menunutrient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
       
        $sql_for_chart = "select sum(calories) as calories,sum(protein) as protein,
        sum(potassium) as potassium,sum(phosphorus) as phosphorus,
        sum(sodium) as sodium,date(a.created_at) as date
        from final_project.meals as a
        left join final_project.menunutrients as b
        on a.menu_id  = b.id
        where a.user_id = $user_id
        group by date(a.created_at)";
        $data_chart = DB::select($sql_for_chart);
        $chart_data = "[";
        $i = 0;
        foreach($data_chart as $r){
            if($i == 0){
                $chart_data .= '{"date" : "'.$r->date.'", "calories" :'.$r->calories.', "protein" :'.$r->protein.', "sodium" :'.$r->sodium.', "potassium" :'.$r->potassium.', "phosphorus" :'.$r->phosphorus.'}';
                $i = 1;
            } else {
                $chart_data .= ',{"date" : "'.$r->date.'", "calories" :'.$r->calories.', "protein" :'.$r->protein.', "sodium" :'.$r->sodium.', "potassium" :'.$r->potassium.', "phosphorus" :'.$r->phosphorus.'}';
            }
        }
        $chart_data .= "]";

        $sql_for_appointment = "select *,datediff(date,curdate()) as date_diff from appointments where user_id = $user_id and date >= curdate() order by date_diff asc ";
        $appointment = DB::select($sql_for_appointment);
        //dd($chart_data);
        
        return view('history')
        ->with('chart_data',$chart_data)
        ->with(compact('appointment'))
        ;
    }
}
