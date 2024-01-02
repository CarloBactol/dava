<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Location;
use App\Models\specialize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminVeterinary extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'super_admin') {
            $veterinary = User::orderBy('first_name', 'ASC')
                ->where('role', 'veterinarian')
                ->get();
        } elseif (Auth::user()->role == 'branch_admin') {

            $getDate = User::Where('role', '!=', 'super_admin')->get();

            // dd($getDate);

            foreach ($getDate as $key => $value) {
                $veterinary = User::orderBy('first_name', 'ASC')
                    ->where('role', 'veterinarian')
                    ->where('branch', Auth::user()->branch)
                    // ->whereIn('specialize_id', explode(',', $value->specialize_id))
                    ->get();
            }
        }
        // dd($veterinary);
        return view('admin.veterinary.index', compact('veterinary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sup_admin = Location::orderby('address', 'ASC')->where('status', '1')->get();
        $specialized = specialize::orderby('title', 'ASC')
            ->where('status', '1')
            ->get();
        $br_admin = Location::orderby('address', 'ASC')
            ->where('status', '1')
            ->where('address', Auth::user()->branch)
            ->get();

        return view('admin.veterinary.create', compact('sup_admin', 'br_admin', 'specialized'));
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
            'firstname' => 'required|string|min:2|max:30',
            'lastname' => 'required|string|min:2|max:30',
            'address' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:veterinaries,phone_number',
            'email' => 'required|unique:veterinaries,email',
            'branch' => 'required|unique:veterinaries,branch',
        ]);

        // Get the selected values from the checkboxes
        $selectedValues = $request->input('specialize');
        if (!empty($selectedValues)) {
            $val = implode(',', $selectedValues);
        } else {
            $val = '';
        }

        $new = new User();
        $new->first_name = $request->firstname;
        $new->last_name = $request->lastname;
        $new->phone_number = $request->phone_number;
        $new->email = $request->email;
        $new->branch = $request->branch;
        $new->address = $request->address;
        $new->role = 'veterinarian';
        $new->specialize_id = $val;
        $new->password = Hash::make('adminpass');
        $new->status = $request->status == "" ? 0 : 1;
        $new->save();
        return redirect()->route('admin.admin_veterinaries.index')->with('success', "Successfully Added.");
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
        $veterinary = User::find($id);
        $specialization = specialize::orderBy('title', 'asc')
            ->where('status', '1')
            ->get();
        $location = Location::orderby('address', 'ASC')->where('status', '1')->get();
        return view('admin.veterinary.edit', compact('veterinary', 'specialization', 'location'));
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
            'firstname' => 'required|string|min:2|max:30',
            'lastname' => 'required|string|min:2|max:30',
            'address' => 'required|string|min:8|max:100',
            'phone_number' => 'required|digits:11|unique:users,phone_number,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'branch' => 'required',
        ]);
        $selectedValues = $request->input('specialize');
        if (!empty($selectedValues)) {
            $val = implode(',', $selectedValues);
        } else {
            $val = '';
        }

        $user = User::find($id);
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->branch = $request->branch;
        $user->address = $request->address;
        $user->role = 'veterinarian';
        $user->specialize_id =  $val;
        $user->address =  $request->address;
        $user->status =  $request->status == "" ? 0 : 1;
        $user->save();
        return redirect()->route('admin.admin_veterinaries.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->route('admin.admin_veterinaries.index')->with('success', 'Successfully Deleted.');
    }
}
