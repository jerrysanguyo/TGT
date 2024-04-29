<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\DataTables\superAdminDataTable;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\User;

class SuperAdminController extends Controller
{
    // ACCOUNT ----------------------------------------------------------------------------------
    public function indexAccount(superAdminDataTable $DataTable)
    {
        $listOfAccounts = User::getAllAccount();
        return $DataTable->render('superadmin.Account.index', compact(
            'listOfAccounts',
            'DataTable',
        ));
    }

    public function showAccount(User $user)
    {
        return view('superadmin.Account.show', compact('user'));
    }

    public function createAccount(Request $request)
    {
        $rules = [
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'string', 'in:admin,user']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try 
        {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            
            return redirect()->route('superadmin.account.index')->with('success', 'User created successfully.');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateAccount(Request $request, User $user)
    {
        $rules = [
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'string', 'in:admin,user']
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try 
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            
            return redirect()->route('superadmin.account.index')->with('success', 'User updated successfully.');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroyAccount(User $user)
    {
        $deleted = $user->delete();
        return redirect()->route('superadmin.account.index')->with('success', 'User deleted successfully.');
    }

    // VOTE -----------------------------------------------------------------------------------------------------
    public function indexVote(superAdminDataTable $DataTable)
    {
        $listOfVotes = Vote::getAllVote();
        return $DataTable->render('superadmin.vote.index', compact(
            'listOfVotes',
            'DataTable',
        ));
    }

    public function showVote(Vote $vote)
    {
        return view('superadmin.vote.show', compact('vote'));
    }

    public function updateVote(Request $request, Vote $vote)
    {
        $rules = [
            'result' => ['required', 'string', 'in:Yes,No'],
        ];

        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        try 
        {
            $vote->update([
                'result' => $request->result,
            ]);
            
            return redirect()->route('superadmin.vote.index')->with('success', 'vote updated successfully.');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroyVote(Vote $vote)
    {
        $deleted = $vote->delete();
        return redirect()->route('superadmin.vote.index')->with('success', 'Vote deleted successfully.');
    }
}
