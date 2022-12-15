<?php

namespace App\Repositories;

use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\Player;
use App\Custom\Game;
use App\Http\Resources\TournamentResource;
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
        
        $this->game->setup($playerIds, $tournament->gender_id);
        $tournamentData = $this->game->init();
        
        $tournament->update([
            'winner' => json_encode($tournamentData['tournament_winner']),
            'history' => json_encode($tournamentData['history'])
        ]);
        $tournament->save();

        return $tournamentData;        
    }

    public function list($data) {
        $query = Tournament::query();
            
        if(isset($data['gender_id'])) {
            $query->where('gender_id', $data['gender_id']);
        }
        
        // if(isset($data['start_date']) || isset($data['end_date'])) {
        //     $start_date = $data['start_date'];
        //     $end_date = $data['end_date'];
        //     $query->whereBetween('created_at', [$start_date, $end_date]);
        // }
        $tournaments = $query->orderBy('created_at', 'desc')->get();

        return TournamentResource::collection($tournaments); 
    }
}