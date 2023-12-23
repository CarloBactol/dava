<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GcashNumber;
use Illuminate\Http\Request;

class AccountGcash extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = GcashNumber::all();
        return view('admin.account.index', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required|string|min:2|max:40',
            'account_number' => 'required|digits:11',
            'cost' => 'required|numeric',
        ]);

        GcashNumber::create($request->all());
        return redirect()->route('admin.account_gcashes.index')->with('success', "Successfully saved.");
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
        $account = GcashNumber::find($id);
        return view('admin.account.edit', compact('account'));
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
        $this->validate($request, [
            'account_name' => 'required|string|min:2|max:40',
            'account_number' => 'required|digits:11',
            'cost' => 'required|numeric',
        ]);

        $account = GcashNumber::find($id);
        $account->account_name = $request->account_name;
        $account->account_number = $request->account_number;
        $account->cost = $request->cost;
        $account->status = $request->status == "" ? 0 : 1;
        $account->save();
        return redirect()->route('admin.account_gcashes.index')->with('info', "Successfully update.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = GcashNumber::find($id);
        $delete->delete();
        return redirect()->route('admin.account_gcashes.index')->with('danger', 'Successfully Deleted.');
    }
}
