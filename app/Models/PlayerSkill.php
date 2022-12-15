<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;

class PlayerSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'skill_id',
        'points'
    ];

    public function skill(){

        return $this->belongsTo(Skill::class);
    }
}
