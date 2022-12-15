<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ITournamentRepository;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\IndexTournamentRequest;
use App\Models\Tournament;
use Carbon\Carbon;


class TournamentController extends Controller
{
    private $repository;

    public function __construct(ITournamentRepository $repository) {
        $this->repository = $repository;
    }

    public function index(IndexTournamentRequest $request) {
        return $this->repository->list($request->input());
    }
    public function store(StoreTournamentRequest $request) {
        return $this->repository->create($request->input());
    }
    
}
