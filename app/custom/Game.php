<?php namespace App\Custom;

use App\Models\Player;
use App\Models\Gender;

class Game 
{
    private $WEIGHT_SKILL_LEVEL;
    private $WEIGHT_STRENGTH;
    private $WEIGHT_VELOCITY_OF_DESPLACEMENT;
    private $WEIGHT_REACTION_TIME;
    
    private $history;
    private $tournamentGenderId;

    public function __construct() {
        $this->WEIGHT_SKILL_LEVEL = 3;
        $this->history = [];
        $this->tournamentGenderId;
    }

    public function init($playerIds, $gender_id) {
        
        $this->tournamentGenderId = $gender_id;
        shuffle($playerIds);
        return $this->tournamentinit($playerIds, $this->history);

    }

    // Recursive method until number of players is 1
    public function tournamentinit($playerIds, $history) {
        
        $numberOfPlayers = count($playerIds);   
        
        if ($numberOfPlayers == 1) {
            return [
                'tournament_winner' =>Player::find($playerIds, ['id', 'name']),
                'history' => $history
            ];
        }

        $array_match = [];
        $array_winnings = [];
        
        // Match extreme players. Ejemplo: [1, 2, 3, 4] -> [1, 4] [2, 3]
        for($i = 0; $i <= ($numberOfPlayers/2) - 1 ; $i++) {    

            $winningPlayer = $this->matchPlayer(
                $playerIds[$i], // Player first
                $playerIds[$numberOfPlayers-$i-1] // Last Player
            );

            array_push($array_winnings, $winningPlayer['player']['id']);    
            
            array_push($array_match, [
                'players' => [ $playerIds[$i], $playerIds[$numberOfPlayers-$i-1] ],
                'winner' => $winningPlayer
            ]);

        }

        // Save history
        array_push($history, $array_match);

        return $this->tournamentinit($array_winnings, $history);
    }

    public function matchPlayer($playerA, $playerB) {
                
        $skillsPointsA = $this->getSkillPoints($playerA);
        $skillsPointsB = $this->getSkillPoints($playerB);
        
        return $this->compareSkillsAndReturnWinner($skillsPointsA, $skillsPointsB);

    }

    public function getSkillPoints($player) {

        $player = Player::find($player, ['id', 'name', 'gender_id']);
        $skillsByGender = Gender::where('id', $player->gender_id)->first()->skills()->get(['skills.id', 'name']);
        $skillsPlayer = $player->playerSkills()->pluck('points', 'skill_id');

        $skillPoints = [];

        foreach($skillsByGender as $skill) {
            $skillPoints[$skill->name] = isset($skillsPlayer[$skill->id]) ? $skillsPlayer[$skill->id] : 0;
        }

        return [
            'player' => $player,
            'points' => $skillPoints
        ];
    }

    public function compareSkillsAndReturnWinner($skillsPointsA, $skillsPointsB) {

        $dataA = $this->addTotalScore($skillsPointsA);
        $dataB = $this->addTotalScore($skillsPointsB);

        if ($dataA['score'] == $dataB['score']) {
            return $this->compareSkillsAndReturnWinner($skillsPointsA, $skillsPointsB);
        }

        return $dataA['score'] > $dataB['score'] ? $dataA : $dataB;

    }

    public function addTotalScore($skillsPoints) {

        $points = $skillsPoints['points'];
        $genderId = $this->tournamentGenderId;
        
        if ($this->isMaleTournament($genderId)) {
            $skillsPoints['score'] = $score = $this->WEIGHT_SKILL_LEVEL * rand(0, $points['skill_level']) + $points['strength'] + $points['velocity_of_displacement'];            
        }

        if ($this->isFemaleTournament($genderId)) {
            $skillsPoints['score'] = $score = $this->WEIGHT_SKILL_LEVEL * rand(0, $points['skill_level']) + $points['reaction_time'];            
        }

        return $skillsPoints;
        
    }

    public function isMaleTournament($genderId) {
        return $genderId == 1;
    }

    public function isFemaleTournament($genderId) {
        return $genderId == 2;
    }
}