<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TournamentRepositoryInterface;
use App\Http\Requests\StoreTournamentRequest;


class TournamentController extends Controller
{
    private $repository;

    public function __construct(TournamentRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function store(StoreTournamentRequest $request) {

        return $this->repository->create($request->input());

    }
    
}
