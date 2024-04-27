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
    
        if ($request->hasFile('file_name')) {
            $destination_path = 'contestant';
            $image = $request->file('file_name');
            $image_name = $image->getClientOriginalName();
        
            try {
                $path = $request->file('file_name')->storeAs($destination_path, $image_name, 'public');
                $validated['file_name'] = $image_name;
            } catch (\Exception $e) {
                \Log::error("File upload error: " . $e->getMessage());
                return back()->withErrors('File upload failed.');
            }
        }
    
        $validated['created_by'] = auth()->id();
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
