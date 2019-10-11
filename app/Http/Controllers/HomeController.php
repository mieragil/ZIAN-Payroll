<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function dashboard()
    {
        $users = User::where('priority','LO')->where('active','1')->paginate(3);
        return view('admin.dashboard', compact('users'));
    }

    public function homedashboard()
    {
        $users = User::where('priority','LO')->where('active','1');
        return view('admin.homedashboard', compact('users'));
    }
}
