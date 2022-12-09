<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender', 
        'skill_level',
        'strength',
        'velocity_of_displacement',
        'reaction_time'
    ];
    
}
