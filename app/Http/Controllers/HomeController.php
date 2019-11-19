<?php

namespace App\Http\Controllers;

use App\Department;
use App\Attendance;
use App\holiday;
use App\Leave;
use App\Overtime;
use App\User;
use App\Item;
use App\Schedule;
use DateTime;
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
        $sched = Schedule::where('emp_id', Auth::user()->id)->first();
        $date1 = new DateTime($sched->req_in);
        $date2 = new DateTime($sched->req_out);
        $in = $date1->format('h:i a') ;
        $out = $date2->format('h:i a') ;

        // return $sched->dayoff;
        $day = "";
        if($sched->dayoff == 'SUN'){
            $day = 'Sunday';
        }elseif($sched->dayoff == 'MON'){
            $day = 'Monday';
        }elseif($sched->dayoff == 'TUE'){
            $day = 'Tuesday';
        }elseif($sched->dayoff == 'WED'){
            $day = 'Wednesday';
        }elseif($sched->dayoff == 'THU'){
            $day = 'Thursday';
        }elseif($sched->dayoff == 'FRI'){
            $day = 'Friday';
        }elseif($sched->dayoff == 'SAT'){
            $day = 'Saturday';
        }
        $schedule = Schedule::where('emp_id', Auth::user()->id)->get();
        $data['OTs'] = Overtime::where('emp_id', Auth::user()->id)->get();
        $account = Item::where('emp_id', Auth::user()->id)->get();
        $attend = Attendance::where('emp_id', Auth::user()->id)->orderby('id', 'DESC')->get();

        return view('home', compact('data', 'account', 'attend', 'day', 'in','out'));
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


        // $overtime = Overtime::where('status', 'PENDING')->get();
        $overtime = DB::table('users')->select(['users.name', 'overtimes.emp_id', 'overtimes.reason', 'overtimes.minutes', 'overtimes.reason', 'overtimes.date'])
                    ->join('overtimes', 'users.id', 'overtimes.emp_id')
                    ->where('status','PENDING')->get();

        $day = date("Y-m-d");
        $attendance = DB::table('users')->select([
                        'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out', 'attend_date',
                        ])->join('attendances','attendances.emp_id','=','users.id')->where('attend_date', $day)
                        ->get();

        return view('admin.homedashboard', compact('users' , 'department', 'leave', 'attendance','overtime', 'holidays'));
        // return $data['attendance'];
    }


    public function settings()
    {
        $department = Department::distinct()->get('department_name');
        $position = Department::all();
        $holidays = holiday::all();

        return view('admin.settings', compact('department', 'position' , 'holidays'));
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
