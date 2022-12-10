<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'gender_skills');
    }
}
