<?php

namespace App\Http\Controllers;

use App\Department;
use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $users = User::where('priority','LO')->where('active','1')->paginate(8);
        $showDep = Department::distinct()->get('department_name');
        $showPos = Department::all();

        return view('admin.dashboard', compact('users', 'showDep', 'showPos'));
    }

    public function fetchdepartment()
    {
        $dep_id = Input::get('dep_id');
        $db = Department::all()->where('department_name', $dep_id);
        foreach($db as $row){
            echo '<option value="' .$row->position. '">'.$row->position.'</option>';
        }
    }

    public function homedashboard()
    {
        $users = User::all()->where('priority','LO')->where('active','1');
        $department = Department::distinct()->get('department_name');
        $leave = Leave::all();

        return view('admin.homedashboard', compact('users' , 'department', 'leave'));
    }

    public function attendance()
    {
        $users = User::where('priority','LO')->where('active','1')->paginate(2);
        return view('admin.attendance', compact('users'));
    }

    public function settings()
    {
        $department = Department::distinct()->get('department_name');
        $position = Department::all();

        return view('admin.settings', compact('department', 'position'));
    }



    public function deductions($id)
    {
        // $user = User::where('id', $id);
        // return $id;
    }
}
