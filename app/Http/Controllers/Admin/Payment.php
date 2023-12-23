<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gcash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Payment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending = Gcash::orderBy('created_at', 'ASC')
            ->where('status', '0')
            ->get();
        $paid = Gcash::orderBy('created_at', 'ASC')
            ->where('status', '1')
            ->get();
        return view('admin.gcash.index', compact('pending', 'paid'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gcash = Gcash::find($id);
        return view('admin.gcash.edit', compact('gcash'));
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
        $updatePayment = Gcash::find($id);
        $updatePayment->status = $request->status;
        $updatePayment->save();
        return redirect()->route('admin.payments.index')->with('success', "Successfully Paid.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Gcash::findorFail($id);
        $delete->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Successfully Deleted.');
    }
}
