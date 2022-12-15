<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id',
        'player_id',
        'player_name',
        'player_gender_id',
        'skills'
    ];

    public static function createFromPlayer($tournamentId, $player) {
        TournamentPlayer::create([
            'tournament_id' => $tournamentId,
            'player_id' => $player->id,
            'player_name' => $player->name,
            'player_gender_id' => $player->gender_id,
            'skills' => json_encode($player->skills)
        ]);
    }
}
