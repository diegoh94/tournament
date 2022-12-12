<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function store(Request $request) {
        
        $rules = [
            'player_ids' => 'required|array|min:2',
            'player_ids.*' => 'integer|distinct|exists:players,id' 
        ];

        $this->validate($request, $rules);

        dd($request->input());
    }
}
