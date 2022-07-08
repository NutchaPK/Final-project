<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userinformation;
use App\Models\Usernutrient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $userinf = Userinformation::find($user_id)->orderByDESC('id')->first();
        $nutrient = new Usernutrient([
            'calories' => 30 * $userinf->weight,
                    'protein' => 0.8 * $userinf->weight,
                    'potassium' => 3000,
                    'phosphorus' => 1000,
                    'sodium' => 2000
        ]);
        
        $usernutrient = Usernutrient::where('user_id',$user_id)->orderByDESC('id')->first();
        
        return view('profile')
        ->with(compact('user'))
        ->with(compact('userinf'))
        ->with(compact('nutrient'))
        ->with(compact('usernutrient'))


       
        ;
    }
}
