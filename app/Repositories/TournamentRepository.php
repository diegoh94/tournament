<?php

namespace App\Repositories;

use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\Player;
use App\Custom\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TournamentRepository implements ITournamentRepository
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function create($data) {
        
        $tournament = Tournament::create([
            'name' => $data['name'],
            'gender_id' => $data['gender_id']
        ]);

        // store tournament_players
        $playerIds = $data['player_ids'];
        $players = Player::whereIn('id', $playerIds)->get(['id', 'name', 'gender_id']);
        
        foreach($players as $player) {
            TournamentPlayer::createFromPlayer($tournament->id, $player);
        }
        
        $tournamentData = $this->game->setup($playerIds, $tournament->gender_id);
        $tournamentData = $this->game->init();
        
        $tournament->update([
            'winner' => json_encode($tournamentData['tournament_winner']),
            'history' => json_encode($tournamentData['history'])
        ]);

        return $tournamentData;        
    }
}