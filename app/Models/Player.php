<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender_id'
    ];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function skills()
    {
        return $this->hasMany('App\Models\PlayerSkill');
    }

    public function playerSkills()
    {
        return $this->hasMany('App\Models\PlayerSkill');
    }
}
