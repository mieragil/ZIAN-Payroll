<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use DateTime;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now('GMT+8')->format('Y-m-d');

        $users = User::all()->where('active', 1)->where('priority', 'LO');

        $attendance = DB::table('users')->select([
            'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out', 'attend_date', 'attendances.id as att_id'
            ])->join('attendances','attendances.emp_id','=','users.id')->where('attend_date', $date)->orderBy('attendances.id', 'DESC')->get();

            
        return view('admin.attendance', compact('attendance', 'users') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //hinde te man proceed
        $date = Carbon::now('GMT+8')->format('Y-m-d');
        $time = Carbon::now('GMT+8')->format('H:i');

        $checker = Attendance::where('attend_date', $date)->where('emp_id',$request->emp_id)->get();
        if($checker->isEmpty()){
            Attendance::create([
                'emp_id' => $request->emp_id,
                'time_in' => $time,
                'attend_date' => $date
            ]);
        }else{
            //check if last time in is greater than 3 minutes to avoid immediate timeout
            $check_timein = Attendance::select('time_in')->where('emp_id', $request->emp_id)->where('attend_date', $date)->first();
            $time2 = strtotime($check_timein->time_in);
            $time1 = strtotime($time);
            $interval  = abs($time2 - $time1);
            $difference   = round($interval / 60);

            if($difference > 3){
                $checkertimeout = Attendance::select('time_out')
                                ->where('emp_id', $request->emp_id)
                                ->where('attend_date', $date)
                                ->first();
                if(is_null($checkertimeout->time_out))
                {
                    Attendance::where('attend_date',$date)->where('emp_id', $request->emp_id)->update([
                        'time_out' => $time
                    ]);
                }
            }

            //get time in and out of user
            $timein = Attendance::select('time_in')->where('emp_id', $request->emp_id)->where('attend_date', $date)->first();
            $timeout = Attendance::select('time_out')->where('emp_id', $request->emp_id)->where('attend_date', $date)->first();
            $in = strtotime(($timein->time_in));
            $out = strtotime(($timeout->time_out));
            $interval  = abs($out - $in);
            $minutes   = round($interval / 60);

            //get per minute rate
            $user = User::where('id', $request->emp_id)->first();
            $per_minute = $user->rate / 8 / 60;
            $pay = $minutes * $per_minute;

            //overtime
            if ((int)$minutes >= 540) {
                $overtime = (int)$minutes - 540;
                $ot_pay = $overtime * $per_minute;

                //get OT if greather than 1 hour
                if(60 > $overtime){
                    Attendance::where('attend_date',$date)->where('emp_id', $request->emp_id)->update([
                        'overtime' => $overtime,
                        'undertime' => '0',
                        'pay_for_day' => $user->rate,
                        'otpay_for_day' => '0',
                        'ded_for_day' => '0'
                    ]);
                }else{
                    Attendance::where('attend_date',$date)->where('emp_id', $request->emp_id)->update([
                        'overtime' => $overtime,
                        'undertime' => '0',
                        'pay_for_day' => $pay,
                        'otpay_for_day' => $ot_pay,
                        'ded_for_day' => '0'
                    ]);
                }
            } else {
                //undertime
                $undertime = 540 - (int)$minutes;
                $deduction = $per_minute * $undertime;

                Attendance::where('attend_date',$date)->where('emp_id', $request->emp_id)->update([
                    'undertime' => $undertime,
                    'overtime' => '0',
                    'pay_for_day' => $pay,
                    'ded_for_day' => $deduction
                ]);
            }
        }


        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function seekdate(Request $request){
        $users = User::all()->where('active', 1)->where('priority', 'LO');


        $attendance = DB::table('users')->select([
            'users.name', 'users.id', 'attendances.time_in', 'attendances.time_out', 'attend_date', 'attendances.id as att_id'
            ])->join('attendances','attendances.emp_id','=','users.id')->where('attend_date', $request->date)
            ->where('users.name', $request->name)
            ->orderBy('attendances.id', 'DESC')->get();
        return view('admin.attendance', compact('attendance', 'users') );


        return redirect()->back()->with('attendance','users');
    }
}
