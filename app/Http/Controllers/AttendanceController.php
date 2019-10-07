<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use DateTime;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
            //get time in and out of user
            $timein = Attendance::select('time_in')->where('emp_id', $request->emp_id)->where('attend_date', $date)->first();
            $timeout = Attendance::select('time_out')->where('emp_id', $request->emp_id)->where('attend_date', $date)->first();    
            $in = strtotime(($timein->time_in));
            $out = strtotime(($timeout->time_out));
            $interval  = abs($out - $in);
            $minutes   = round($interval / 60);
            //get daily rate
            $user = User::where('id', $request->emp_id)->first();
            $per_minute = $user->rate / 9 / 60;
            $pay = $minutes * $per_minute;
    
            //overtime
            if ((int)$minutes >= 540) {
                $overtime = (int)$minutes - 540;

                // return $overtime;
                $ot_pay = $overtime * $per_minute;

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
}
