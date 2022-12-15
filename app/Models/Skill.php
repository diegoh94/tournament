<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;

class Skill extends Model
{
    use HasFactory;

    public function genders()
    {
        return $this->belongsToMany('App\Models\Gender', 'gender_skills');
    }

}
