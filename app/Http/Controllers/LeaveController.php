<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all()->where('priority', 'LO')->where('active', 1);
        $leavers = Leave::all();
        return view('admin.leave', compact('data', 'leavers'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $data = array();
        // $data['user'] = User::findOrFail($id);
        // $data['leave'] = Leave::where('emp_id',$id)->get();
        // return view('admin.leave', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    public function acceptleave(Request $request){
        // return $request;

        if($request->firstdate > $request->seconddate){
            // echo "tama el date     " . $request->firstdate . "    " . $request->seconddate;
            return back()->withErrors('Leave date is invalid, try again.');
        }else{
            $first = $request->firstdate;
            $second = $request->seconddate;
            $id = $request->id;
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $first);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $second);
            $diff_in_days = $to->diffInDays($from);
            $user = User::findOrFail($id);


            Leave::create([
                'emp_id' => $id,
                'emp_name' => $user->name,
                'reason' => $request->reason,
                'total_days' => $diff_in_days,
                'dates_of_leave' => $first . " to " . $second,
                'paid' => $request->paid
            ]);

            return redirect('leave')->with('success','Added leave.');
        }
    }
}
