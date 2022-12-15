<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\Player;
use App\Models\PlayerSkill;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlayerRepository implements IPlayerRepository
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

    public function list() {
        return Player::orderBy('created_at', 'desc')->get(['id', 'name', 'gender_id'])->map(function ($player) {
            $player->skills->map(function($playerSkill) {
                $playerSkill->name = Skill::find($playerSkill->skill_id)->name;
                unset($playerSkill->id);
                unset($playerSkill->player_id);
                unset($playerSkill->created_at);
                unset($playerSkill->updated_at);
                return $playerSkill;
            });
            return $player;
        });
    }
}