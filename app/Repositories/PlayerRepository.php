<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\Player;
use App\Models\PlayerSkill;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function create($data) {
        
        $player = Player::create([
            'name' => $data['name'],
            'gender_id' => $data['gender_id']
        ]);

        $skills = $player->gender->skills()->get(['skills.id', 'skills.name']);

        foreach ($skills as $skill) {
            if (isset($data[$skill->name])) {
                PlayerSkill::create([
                    'player_id' => $player->id,
                    'skill_id' => $skill->id,
                    'points' => $data[$skill->name]
                ]);
            }
        }
        
    }
}