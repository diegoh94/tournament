<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerSkill extends Model
{
    protected $fillable = [
        'player_id',
        'skill_id',
        'points'
    ];

    use HasFactory;
}
