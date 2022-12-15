<?php namespace App\Custom;

use App\Models\Player;
use App\Models\Gender;

class Game 
{
    const WEIGHT_SKILL_LEVEL = 3;
    const GENDER_MALE_ID = 1;
    const GENDER_FEMALE_ID = 2;
    
    private $history;
    private $tournamentGenderId;
    private $playerIds;

    public function __construct() {
        $this->history = [];
        $this->tournamentGenderId;
        $this->playerIds;
    }

    public function setup($playerIds, $gender_id) {
        shuffle($playerIds);
        $this->playerIds = $playerIds;
        $this->tournamentGenderId = $gender_id;
    }

    public function init() {
        return $this->tournamentinit($this->playerIds, $this->history);
    }

    // Recursive method until number of players is 1
    public function tournamentinit($playerIds, $history) {
        
        $numberOfPlayers = count($playerIds);   
        
        if ($numberOfPlayers === 1) {
            return [
                'tournament_winner' =>Player::find($playerIds, ['id', 'name']),
                'history' => $history
            ];
        }

        $arrayMatch = [];
        $arrayWinnings = [];
        
        // Match extreme players. Ejemplo: [1, 2, 3, 4] -> [1, 4] [2, 3]
        for($i = 0; $i <= ($numberOfPlayers/2) - 1 ; $i++) {    

            $winningPlayer = $this->matchPlayer(
                $playerIds[$i], // Player first
                $playerIds[$numberOfPlayers-$i-1] // Last Player
            );

            array_push($arrayWinnings, $winningPlayer['player']['id']);    
            
            array_push($arrayMatch, [
                'players' => [ $playerIds[$i], $playerIds[$numberOfPlayers-$i-1] ],
                'winner' => $winningPlayer
            ]);

        }

        // Save history
        array_push($history, $arrayMatch);

        return $this->tournamentinit($arrayWinnings, $history);
    }

    public function matchPlayer($playerA, $playerB) {
                
        $skillsPointsA = $this->getSkillPoints($playerA);
        $skillsPointsB = $this->getSkillPoints($playerB);
        
        return $this->compareSkillsAndReturnWinner($skillsPointsA, $skillsPointsB);

    }

    public function getSkillPoints($player) {

        $player = Player::find($player, ['id', 'name', 'gender_id']);
        $skillsByGender = Gender::where('id', $player->gender_id)->first()->skills()->get(['skills.id', 'name']);
        $skillsPlayer = $player->skills()->pluck('points', 'skill_id');

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

        if ($dataA['score'] === $dataB['score']) {
            return $this->compareSkillsAndReturnWinner($skillsPointsA, $skillsPointsB);
        }

        return $dataA['score'] > $dataB['score'] ? $dataA : $dataB;

    }

    public function addTotalScore($skillsPoints) {

        $points = $skillsPoints['points'];
        $genderId = $this->tournamentGenderId;
        
        if ($this->isMaleTournament($genderId)) {
            $skillsPoints['score'] = $score = Game::WEIGHT_SKILL_LEVEL * rand(0, $points['skill_level']) + $points['strength'] + $points['velocity_of_displacement'];            
        }

        if ($this->isFemaleTournament($genderId)) {
            $skillsPoints['score'] = $score = Game::WEIGHT_SKILL_LEVEL * rand(0, $points['skill_level']) + $points['reaction_time'];            
        }

        return $skillsPoints;
        
    }

    public function isMaleTournament($genderId) {
        return $genderId === Game::GENDER_MALE_ID;
    }

    public function isFemaleTournament($genderId) {
        return $genderId === Game::GENDER_FEMALE_ID;
    }
}