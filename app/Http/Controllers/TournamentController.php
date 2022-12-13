<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\Player;


class TournamentController extends Controller
{
    public function store(StoreTournamentRequest $request) {

        /* {
            "name": "Mundial de galletitas",
            "player_ids": [2,1],
            "gender_id": 2
        }*/

        $tournament = Tournament::create($request->only('name', 'gender_id'));

        // store tournament_players
        $player_ids = $request->input('player_ids');
        $players = Player::whereIn('id', $player_ids)->get(['id', 'name', 'gender_id']);
        
        foreach($players as $player) {
            TournamentPlayer::create([
                'tournament_id' => $tournament->id,
                'player_id' => $player->id,
                'player_name' => $player->name,
                'player_gender_id' => $player->gender_id,
                'skills' => json_encode($player->skills)
            ]);
        }
        
    }
}
