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
        
        shuffle($playerIds); // desordenar array ids    
        
        // logica de torneo
        $tournament_history = [];
        $winner = $this->tournamentinit($playerIds, $tournament_history);
        
        dd($winner);
    }

    public function tournamentinit($playerIds, $tournament_history) {
        
        $n = count($playerIds);   
        
        if ($n == 1) { dump($tournament_history);
            return $playerIds;
        }

        $array_encuentros = [];
        $array_winnings = [];
        
        for($i = 0; $i <= ($n/2) - 1 ; $i++) {    
            
            // Establece un player ganador con base en sus skills
            $winningPlayer = $this->matchPlayer($playerIds[$i], $playerIds[$n-$i-1]);

            // Actualiza arreglo con ganadores de la primera ronda
            array_push($array_winnings, $winningPlayer);    
            
            // Guarda los encuentros con sus respectivos ganadores para tener un historial del torneo
            array_push($array_encuentros, [
                'players' => [ $playerIds[$i], $playerIds[$n-$i-1] ],
                'winner' => $winningPlayer
            ]);
        }

        // Guarda historial de todas las fases
        array_push($tournament_history, $array_encuentros);

        $this->tournamentinit($array_winnings, $tournament_history);
    }

    public function matchPlayer($playerA, $playerB) {
        return $playerB; // lógica provisional, da como ganador siempre al segundo jugador
    }
}
