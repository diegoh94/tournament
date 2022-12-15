<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\Http\Requests\SkillByGenderRequest;

class SkillController extends Controller
{
    /**
     * Skill by gender List
     */
    public function byGender(SkillByGenderRequest $request) {
        
        $skillsByGender  = [
            'm' => Gender::where('name', 'masculino')->first()->skills()->pluck('name'), 
            'f' => Gender::where('name', 'femenino')->first()->skills()->pluck('name')
        ];

        $gender = strtolower($request->input('gender'));
        
        return $skillsByGender[$gender];

    }
}
