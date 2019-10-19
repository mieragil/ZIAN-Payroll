<?php

namespace App\Http\Controllers;

use App\Deduction;
use App\User;
use App\CashAdvance;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->select(['users.name', 'deductions.SSS', 'deductions.PHIC', 'deductions.PAG_IBIG'])
                ->join('deductions','deductions.emp_id', '=', 'users.id')->get();
        return view('admin.deduction', compact('user'));
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
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        //
    }

    public function showCA(){
        $data = array();
        $data['users'] = User::where('priority','LO')->get(); 
        $data['CA'] = CashAdvance::where('request','!=', 0)->get();
        $data['tables'] = DB::table('users')->select([
                        'users.name', 'cashadvances.request', 'cashadvances.ded_per_pay', 'cashadvances.months_to_pay','cashadvances.date_issued'
                        ])->join('cashadvances','cashadvances.emp_id','=','users.id')
                        ->get();

        // return $data['tables'];

        return view('admin.cash-advance', compact('data'));
    }

    public function storeCA($id, Request $request){

        // if($request->get('request') > 100000){
        //     return redirect()->back()->withErrors($request->get('request') . ' as requested amount is invalid.');
        // }elseif($request->get(''))

        $user = User::findOrFail($request->employees);
        $check = CashAdvance::where('emp_id', $request->employees)->where('request','!=', '0')->get();
        if($check->isEmpty()){
            CashAdvance::create([
                'emp_id' => $request->get('employees'),
                'reason' => $request->get('reason'),
                'request' => $request->get('request'),
                'ded_per_pay' => $request->get('ded_per_pay'),
                'date_issued' => $request->get('date_issued'),
                'months_to_pay' => $request->get('months_to_pay')
            ]);
            return redirect()->back()->with('success', 'Registered ' . $request->get('request') . ' Cash Advance to: ' . $user->name);
        }else{
            $record = CashAdvance::where('emp_id', $request->employees)->first();
            $new_amount = (int)$record->request + (int)$request->get('request');
            CashAdvance::where('emp_id', $request->employees)->update([
                'request' => $new_amount,
                'date_issued' => $request->get('date_issued'),
                'ded_per_pay' => $request->get('ded_per_pay'),
                'months_to_pay' => $request->get('months_to_pay')
            ]);
            return redirect()->back()->with('success', 'Updated' . $request->get('request') . ' Cash Advance to: ' . $user->name);

        } 
    }
}
