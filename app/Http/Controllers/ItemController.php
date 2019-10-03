<?php

namespace App\Http\Controllers;

use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        // return $request;
        Item::create([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'emp_id' => $request->emp_id,
            'date_issued' => Carbon::now()
        ]);

        return back()->with('success', 'Added: ' . $request->item_name . ' x ' . $request->quantity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function deduct(Request $request){
        $left = '';
        // return $request;

        $item = Item::findOrFail($request->ded_item_id);
        // return $item;

        if($request->ded_quantity > $item->quantity){
            $left = '0';
        }else{
            $left = $item->quantity - $request->ded_quantity;
        }

        Item::where('id', $request->ded_item_id)
            ->where('emp_id', $request->ded_user_id)
            ->update(['quantity' => $left]);
        return back()->with('success', 'Deducted ' . $request->ded_quantity . ' to ' . $item->item_name);
    }

    public function add(Request $request){
        $left = '';
        // return $request;

        $item = Item::findOrFail($request->add_item_id);
        // return $item;


        $left = $item->quantity + $request->add_quantity;

        Item::where('id', $request->add_item_id)
            ->where('emp_id', $request->add_user_id)
            ->update(['quantity' => $left]);
        return back()->with('success', 'Added ' . $request->add_quantity . ' to ' . $item->item_name);
    }
}
