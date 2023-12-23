<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminOwner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'super_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where('role', 'client')
                ->where('branch', '!=', '')
                ->get();
        } elseif (Auth::user()->role == 'branch_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where('branch', Auth::user()->branch)
                ->where('role', 'client')
                ->get();
        }

        return view('admin.owner.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->role == 'super_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where("role", 'client')
                ->where('status', '1')
                ->get();
            $location = Location::orderby('address', 'ASC')->where('status', '1')->get();
        } elseif (Auth::user()->role == 'branch_admin') {

            // dd(Auth::user()->branch);


            $users = User::orderBy('email', 'ASC')
                ->where("role", 'client')
                ->where('branch', Auth::user()->branch)
                ->where('status', '1')
                ->get();

            $location = Location::where('address', Auth::user()->branch)->where('status', '1')->get();
        }


        return view('admin.owner.create', compact('users', 'location'));
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
            'address' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:users,phone_number',
            'email' => 'required|unique:users,email',
            'branch' => 'required',
        ]);

        // Owner::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'address' => $request->address,
        //     'phone_number' => $request->phone_number,
        //     'email' => $request->email,
        //     'branch' => $request->branch,
        //     'status' => $request->status == "" ? 0 : 1,
        // ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'branch' => $request->branch,
            'role' => 'client',
            'password' => Hash::make('adminpass'),
            'status' => $request->status == "" ? 0 : 1,
        ]);

        return redirect()->route('admin.admin_owners.index')->with('success', "Successfully Added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 'super_admin') {
            $location = Location::orderby('address', 'ASC')->where('status', '1')->get();
        } elseif (Auth::user()->role == 'branch_admin') {
            $location = Location::where('address', Auth::user()->branch)->where('status', '1')->get();
        }

        $owner = User::find($id);
        return view('admin.owner.edit', compact('owner',  'location'));
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
            'address' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:users,phone_number,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'branch' => 'required',
        ]);

        $user = User::updateOrCreate([
            'id' => $id
        ], [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'branch' => $request->branch,
            'status' => $request->status == "" ? 0 : 1,

        ]);
        $user->save();
        return redirect()->route('admin.admin_owners.index')->with('info', "Successfully Updated.");
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
        return redirect()->route('admin.admin_owners.index')->with('success', 'Successfully Deleted.');
    }
}
