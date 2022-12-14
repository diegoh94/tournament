<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\Player;
use App\Custom\Game;


class TournamentController extends Controller
{
    private $game;

    public function __construct(Game $game) {
        $this->game = $game;
    }

    public function store(StoreTournamentRequest $request) {

        $tournament = Tournament::create($request->only('name', 'gender_id'));

        // store tournament_players
        $playerIds = $request->input('player_ids');
        $players = Player::whereIn('id', $playerIds)->get(['id', 'name', 'gender_id']);
        
        foreach($players as $player) {
            TournamentPlayer::create([
                'tournament_id' => $tournament->id,
                'player_id' => $player->id,
                'player_name' => $player->name,
                'player_gender_id' => $player->gender_id,
                'skills' => json_encode($player->skills)
            ]);
        }
        
        return $this->game->init($playerIds);
        
    }
    
}
