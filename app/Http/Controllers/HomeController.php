<?php

namespace App\Http\Controllers;

use App\Department;
use App\Attendance;
use App\holiday;
use App\Leave;
use App\User;
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
        return view('home');
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
        $holidays = holiday::all();

        $day = date("Y-m-d");
        $attendance = DB::table('users')->select([
                        'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out', 'attend_date',
                        ])->join('attendances','attendances.emp_id','=','users.id')->where('attend_date', $day)
                        ->get();

        return view('admin.homedashboard', compact('users' , 'department', 'leave', 'attendance', 'holidays'));

    }


    public function settings()
    {
        $department = Department::distinct()->get('department_name');
        $position = Department::all();

        return view('admin.settings', compact('department', 'position'));
    }

    public function newHoliday(Request $request)
    {
        $name = $request->holiday_name;
        $timestamp = strtotime($request->holiday_date);
        $date = $request->holiday_date;
        $day = date('l', $timestamp);
        holiday::create([
            'holiday_name' => $name,
            'holiday_date' => $date,
            'holiday_day' => $day,
        ]);

        return back();
    }
}
