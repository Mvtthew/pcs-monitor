<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }

    /**
     * Get user dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard() {
        return view('user.dashboard');
    }
}
