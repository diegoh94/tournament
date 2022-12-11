<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerSkill;
use App\Http\Requests\StorePlayerRequest;
use App\Repositories\PlayerRepositoryInterface;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    private $repository;

    public function __construct(PlayerRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return Player::orderBy('created_at', 'desc')->get();
    }

    public function store(StorePlayerRequest $request) {
        
        try {
            $this->repository->create($request->input());
            return response()->json(['message' => 'Successfully registered player'], 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e]);
        }

    }

    public function update(StorePlayerRequest $request, Player $player) {

        $gender = strtolower($request->input('gender'));
        
        if ($gender == 'm') {
            $player->update($request->only('name', 'gender', 'skill_level', 'strength', 'velocity_of_displacement', 'reaction_time'));
        }

        if ($gender == 'f') {
            $player->update($request->only('name', 'gender', 'skill_level', 'reaction_time'));
        }

        return response()->json(['message' => 'Jugador actualizado exitosamente'], 200);

    }
}
