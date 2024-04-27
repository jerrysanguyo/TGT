<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Contestant;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;

class VoteController extends Controller
{
    public function getVotes(Contestant $contestant)
    {
        $votes = $contestant->votes()
                            ->with('user')
                            ->get();

        return response()->json($votes);
    }
    
    public function yesVote(StoreVoteRequest $request)
    {
        $contestantId = $request->input('contestant_id');
        $ratedBy = auth()->id();
        $result = 'Yes';
        
        Vote::create([
            'contestant_id' => $contestantId,
            'rated_by' => $ratedBy,
            'result' => $result
        ]);
        
        $redirectRoute = auth()->user()->role === 'admin' ? 'admin.vote' : 'superadmin.vote';
        return redirect()->route($redirectRoute, ['contestant' => $contestantId])
                        ->with('Yes', 'Vote has been submitted!');
    }

    public function noVote(StoreVoteRequest $request)
    {
        $contestantId = $request->input('contestant_id');
        $ratedBy = auth()->id();
        $result = 'No';
        
        Vote::create([
            'contestant_id' => $contestantId,
            'rated_by' => $ratedBy,
            'result' => $result
        ]);
        
        $redirectRoute = auth()->user()->role === 'admin' ? 'admin.vote' : 'superadmin.vote';
        return redirect()->route($redirectRoute, ['contestant' => $contestantId])
                        ->with('No', 'Vote has been submitted!');
    }

    public function index()
    {
        //
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreVoteRequest $request)
    {
        //
    }
    
    public function show(Vote $vote)
    {
        //
    }
    
    public function edit(Vote $vote)
    {
        //
    }
    
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }
    
    public function destroy(Vote $vote)
    {
        //
    }
}
