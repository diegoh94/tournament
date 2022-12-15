<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;
use App\Models\PlayerSkill;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender_id'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function skills()
    {
        return $this->hasMany(PlayerSkill::class);
    }
}
