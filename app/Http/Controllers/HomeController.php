<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ParticipantsDataTable;
use App\Models\Contestant;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ParticipantsDataTable $DataTable)
    {
        $listOfContestant = Contestant::getAllContestant();
        return $DataTable->render('home', compact(
            'DataTable',
            'listOfContestant'
        ));
    }
}
