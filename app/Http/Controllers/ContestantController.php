<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
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
    
    public function store(StoreContestantRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();

        Contestant::create($validated);

        return redirect()->route('admin.dashboard')
                        ->with('success', 'Contestant added successfully.');
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
    
        return redirect()->route('admin.dashboard')
                        ->with('success', 'Contestant updated successfully.');
    }
    
    public function destroy(Contestant $contestant)
    {
        $deleted = $contestant->delete();

        return redirect()->route('admin.dashboard')
                        ->with('success', 'Contestant deleted successfully.');
    }
}
