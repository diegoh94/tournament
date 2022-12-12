<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\LengthPotencyOfTwo;
use App\Rules\ValidateGender;

class TournamentController extends Controller
{
    public function store(Request $request) {
        
        $rules = [
            'gender_id' => 'integer|exists:genders,id',
            'player_ids' => ['required', 'array', 'min:2', new LengthPotencyOfTwo],            
            'player_ids.*' => ['integer', 'distinct', 'exists:players,id', new ValidateGender($request->input('gender_id'))] 
        ];

        $this->validate($request, $rules);

        dd($request->input());
    }
}
