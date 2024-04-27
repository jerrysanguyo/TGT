<?php

namespace App\Http\Controllers;

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
    
    public function store(StoreContestantRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
    
        if ($request->hasFile('file_name') && $request->file('file_name')->isValid()) {
            $image = $request->file('file_name');
            $imageName = $request->input('name') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('contestant_images', $imageName, 'public');
            $validated['file_name'] = $imageName;
        }
    
        Contestant::create($validated);
    
        $redirectRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'superadmin.dashboard';
        return redirect()->route($redirectRoute)->with('success', 'Contestant added successfully.');
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
