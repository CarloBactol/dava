<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserBranch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_branch = User::where('role', 'branch_admin')->get();
        return view('admin.user_branch.index', compact('user_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = Location::orderby('address', 'ASC')->where('status', '1')->get();
        return view('admin.user_branch.create', compact('location'));
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
            'first_name' => 'required|string|min:2|max:30',
            'last_name' => 'required|string|min:2|max:30',
            'branch' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:users,phone_number',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'branch' => $request->branch,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'branch_admin',
            'status' => $request->status == "" ? 0 : 1,
        ]);

        return redirect()->route('admin.user_branches.index')->with('success', "Successfully added.");
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
        $location = Location::orderby('address', 'ASC')->where('status', '1')->get();
        $user = User::find($id);
        return view('admin.user_branch.edit', compact('location', 'user'));
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
            'first_name' => 'required|string|min:2|max:30',
            'last_name' => 'required|string|min:2|max:30',
            'branch' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:users,phone_number,' . $id,
            'email' => 'required|unique:users,email,' . $id,
        ]);

        $updateUser = User::find($id);
        $updateUser->first_name = $request->first_name;
        $updateUser->last_name = $request->last_name;
        $updateUser->branch = $request->branch;
        $updateUser->phone_number = $request->phone_number;
        $updateUser->email = $request->email;
        $updateUser->password = $request->password;
        $updateUser->status = $request->status == "" ? 0 : 1;
        $updateUser->save();
        return redirect()->route('admin.user_branches.index')->with('info', "Successfully update.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delOwnwer = User::find($id);
        $delOwnwer->delete();
        return redirect()->route('admin.user_branches.index')->with('success', 'Successfully Deleted.');
    }
}
