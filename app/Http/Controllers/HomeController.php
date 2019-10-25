<?php

namespace App\Http\Controllers;

use App\Department;
use App\Attendance;
use App\Leave;
use App\Overtime;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

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
        $data = array();

        $data['OTs'] = Overtime::where('emp_id', Auth::user()->id)->get();
        // return $data['OTs'];


        return view('home', compact('data'));
    }

    public function attendtoday()
    {
        // $day = date("Y.m.d");
        // $data = array();
        // $data['user'] = User::where('priority','LO')->get();
        // $data['attendance'] = Attendance::where('attend_date', $day);
        // $data['tables'] = DB::table('users')->select([
        //                 'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out' ,
        //                 ])->join('attendances','attendances.emp_id','=','users.id')
        //                 ->get();
        // return view('admin.deductions', compact('data'));
    }


    public function dashboard()
    {
        $users = User::where('priority','LO')->where('active','1')->paginate(10);
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

        
        // $overtime = Overtime::where('status', 'PENDING')->get();
        $overtime = DB::table('users')->select(['users.name', 'overtimes.emp_id', 'overtimes.reason', 'overtimes.minutes', 'overtimes.reason', 'overtimes.date'])
                    ->join('overtimes', 'users.id', 'overtimes.emp_id')
                    ->where('status','PENDING')->get();

        $day = date("Y-m-d");
        $attendance = DB::table('users')->select([
                        'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out', 'attend_date',
                        ])->join('attendances','attendances.emp_id','=','users.id')->where('attend_date', $day)
                        ->get();

        return view('admin.homedashboard', compact('users' , 'department', 'leave', 'attendance','overtime'));
        // return $data['attendance'];
    }

    // public function attendance()
    // {
    //     $users = User::where('priority','LO')->where('active','1')->paginate(2);
    //     return view('admin.attendance', compact('users'));
    // }

    public function settings()
    {
        $department = Department::distinct()->get('department_name');
        $position = Department::all();

        return view('admin.settings', compact('department', 'position'));
    }

}
