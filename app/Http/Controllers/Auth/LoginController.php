<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin/dashboard';
        } else if (auth()->user()->role == 'user') {
            return '/user/dashboard';
        } else if (auth()->user()->role == 'superadmin') {
            return '/superadmin/dashboard';
        }
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
