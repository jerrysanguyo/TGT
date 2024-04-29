<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Contestant;
use App\Models\Vote;
use App\Http\Requests\StoreContestantRequest;
use App\Http\Requests\UpdateContestantRequest;

class ContestantController extends Controller
{
    public function index()
    {
        //
    }
    
    public function create()
    {
        //
    }

    
    public function vote(Contestant $contestant) 
    {
        $votes = $contestant->votes()
                        ->where('rated_by', auth()->id())
                        ->get(); 
        $userHasVoted = $contestant->votes()
                        ->where('rated_by', auth()->id())
                        ->exists();
        return view('vote.index', compact(
            'contestant',
            'userHasVoted',
            'votes'
        ));
    }

    public function store(Request $request) 
    {
        $rules = [
            'name' => ['string', 'required', 'max:255'],
            'talent' => ['string', 'required', 'max:255'],
        ];
    
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try 
        {
            Contestant::create([
                'name' => $request->name,
                'talent' => $request->talent,
                'created_by' => auth()->id(),
            ]);
        
            $redirectRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'superadmin.dashboard';
            return redirect()->route($redirectRoute)->with('success', 'Contestant updated successfully.');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function show(Contestant $contestant)
    {
        return view('contestant.details', compact(
            'contestant'
        ));
    }
    
    public function edit(Contestant $contestant)
    {
        return view('contestant.edit', compact(
            'contestant'
        ));
    }
    
    public function update(UpdateContestantRequest $request, Contestant $contestant)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
    
        $contestant->update($validated);
    
        $redirectRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'superadmin.dashboard';
        return redirect()->route($redirectRoute)->with('success', 'Contestant updated successfully.');
    }
    
    public function destroy(Contestant $contestant)
    {
        $deleted = $contestant->delete();
    
        $redirectRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'superadmin.dashboard';
        return redirect()->route($redirectRoute)->with('success', 'Contestant deleted successfully.');
    }
}
