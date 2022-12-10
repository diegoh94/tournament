<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index() {

        return Player::orderBy('created_at', 'desc')->get();

    }

    public function store(StorePlayerRequest $request) {

        $gender = strtolower($request->input('gender'));

        if ($gender == 'm') {
            return Player::create($request->only('name', 'gender', 'skill_level', 'strength', 'velocity_of_displacement', 'reaction_time'));
        }

        if ($gender == 'f') {
            return Player::create($request->only('name', 'gender', 'skill_level', 'reaction_time'));
        }

    }

    public function update(StorePlayerRequest $request, Player $player) {

        $gender = strtolower($request->input('gender'));
        
        if ($gender == 'm') {
            $player->update($request->only('name', 'gender', 'skill_level', 'strength', 'velocity_of_displacement', 'reaction_time'));
        }

        if ($gender == 'f') {
            $player->update($request->only('name', 'gender', 'skill_level', 'reaction_time'));
        }

        return response()->json(['message' => 'Jugador actualizado exitosamente'], 200);

    }
}
