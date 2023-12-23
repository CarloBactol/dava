<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAnimal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'super_admin') {
            $animal = Animal::with('owner')->get();
        } elseif (Auth::user()->role == 'branch_admin') {
            $animal = Animal::orderBy('name', 'ASC')->get();
        }
        return view('admin.animal.index', compact('animal'));
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
                ->where('status', '1')
                ->where("role", 'client')->get();
        } elseif (Auth::user()->role == 'branch_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where('status', '1')
                ->where('branch', Auth::user()->branch)
                ->where("role", 'client')->get();
        }

        return view('admin.animal.create', compact('users'));
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
            'species' => 'required|string|min:2|max:30',
            'breed' => 'required|string|min:2|max:30',
            'name' => 'required|string|min:2|max:30',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'color' => 'required|min:2|max:30',
            'owner' => 'required|numeric',
        ]);

        Animal::create([
            'species' => $request->species,
            'breed' => $request->breed,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'color' => $request->color,
            'owner_id' => $request->owner,
        ]);

        return redirect()->route('admin.admin_animals.index')->with('success', "Successfully Added.");
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
        if (Auth::user()->role == 'super_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where('status', '1')
                ->where("role", 'client')->get();
        } elseif (Auth::user()->role == 'branch_admin') {
            $users = User::orderBy('email', 'ASC')
                ->where('status', '1')
                ->where('branch', Auth::user()->branch)
                ->where("role", 'client')->get();
        }
        $animal = Animal::find($id);
        return view('admin.animal.edit', compact('animal', 'users'));
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
            'species' => 'required|string|min:2|max:30',
            'breed' => 'required|string|min:2|max:30',
            'name' => 'required|string|min:2|max:30',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'color' => 'required|min:2|max:30',
            'owner' => 'required|numeric',
        ]);

        $update_Animal = Animal::find($id);
        $update_Animal->species = $request->species;
        $update_Animal->species = $request->species;
        $update_Animal->breed = $request->breed;
        $update_Animal->name = $request->name;
        $update_Animal->date_of_birth = $request->date_of_birth;
        $update_Animal->gender = $request->gender;
        $update_Animal->color = $request->color;
        $update_Animal->owner_id = $request->owner;
        $update_Animal->save();

        return redirect()->route('admin.admin_animals.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Animal::find($id);
        $delete->delete();
        return redirect()->route('admin.admin_animals.index')->with('danger', 'Successfully Deleted.');
    }
}
