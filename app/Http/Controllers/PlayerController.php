<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function store(StorePlayerRequest $request) {

        $gender = strtolower($request->input('gender'));

        if($gender == 'm') {
            return Player::create($request->only('name', 'gender', 'skill_level', 'strength', 'velocity_of_displacement', 'reaction_time'));
        }

        if($gender == 'f') {
            return Player::create($request->only('name', 'gender', 'skill_level', 'reaction_time'));
        }

    }
}
