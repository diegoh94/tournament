<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Skill;
use App\Models\PlayerSkill;
use App\Http\Requests\StorePlayerRequest;
use App\Repositories\IPlayerRepository;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    private $repository;

    public function __construct(IPlayerRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->list();        
    }

    public function store(StorePlayerRequest $request) {
        
        $this->repository->create($request->input());
        return response()->json(['message' => 'Successfully registered player'], 200);

    }
    
}
