<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;

class SkillController extends Controller
{
    public function byGender(Request $request) {
        
        $rules = [
            'gender' => 'required|in:f,F,m,M'
        ];

        $this->validate($request, $rules);
        
        $skillsByGender  = [
            'm' => Gender::where('name', 'masculino')->first()->skills()->pluck('name'), 
            'f' => Gender::where('name', 'femenino')->first()->skills()->pluck('name')
        ];

        $gender = strtolower($request->input('gender'));
        
        return $skillsByGender[$gender];

    }
}
