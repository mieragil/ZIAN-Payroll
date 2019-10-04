<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Leave;
use DateTime;
use Illuminate\Http\Request;

class PivotController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.employee', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function promote($id, Request $request){
        // return $request;
        $user = User::findOrFail($id);

        if($user->rate > $request->new_rate){
            return back()->withErrors('Please enter a higher rate for ptomotion');
        }
        

        $promotion = '';
        if($user->emp_status == 'TRAINEE'){
            $promotion = 'PROBATIONARY';
        }else{
            $promotion = 'REGULAR';
        }
        User::where('id', $user->id)->update(['emp_status' => $promotion,
            'weeks_of_training' => $request->new_training,
            'rate' => $request->new_rate
        ]);
        return redirect()->back()->with('success', 'Successfully promoted ' . $user->name . ' to : ' .$promotion);
    }

    public function terminate($id){
        $user = User::findOrFail($id);
        User::where('id',$id)->update([
            'active' => '0'
            ]);
        return redirect()->route('dashboard')->with('success','YOU HAVE TERMINATED ' . $user->name);
    }

    public function accountability($id){
        $data = array();
        $data['user'] = User::findOrFail($id);
        $data['items'] = Item::where('emp_id', $id)->where('quantity','!=','0')->get();
        // return $data['items'];
        return view ('admin.accountability', compact('data'));
    }

    public function editEmp($id, Request $request){
        return request()->all();
    }
}
