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
        
        $this->repository->create($request->input());
        return response()->json(['message' => 'Successfully registered player'], 200);

    }
    
}
