<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ParticipantsDataTable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ParticipantsDataTable $DataTable)
    {
        return $DataTable->render('home', compact(
            'DataTable'
        ));
    }
}
