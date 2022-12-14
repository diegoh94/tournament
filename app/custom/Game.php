<?php namespace App\Custom;

class Game 
{
    public function init($playerIds) {

        shuffle($playerIds); // desordenar array ids    
        
        // logica de torneo
        $tournament_history = [];
        return $this->tournamentinit($playerIds, $tournament_history);

    }

    public function tournamentinit($playerIds, $tournament_history) {
        
        $n = count($playerIds);   
        
        if ($n == 1) {
            return [
                'tournament_winner' =>$playerIds,
                'history' => $tournament_history
            ];
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

        return $this->tournamentinit($array_winnings, $tournament_history);
    }

    public function matchPlayer($playerA, $playerB) {
        return $playerB; // lógica provisional, da como ganador siempre al segundo jugador
    }
}