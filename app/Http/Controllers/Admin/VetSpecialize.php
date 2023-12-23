<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\specialize;
use Illuminate\Http\Request;

class VetSpecialize extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specailize = specialize::all();
        return view('admin.specialize.index', compact('specailize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specailize = specialize::orderby('title', 'asc')->where('status', '1')->get();
        return view('admin.specialize.create', compact('specailize'));
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
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:5|max:200',
        ]);

        specialize::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status == "" ? 0 : 1,
        ]);

        return redirect()->route('admin.vet_specializes.index')->with('success', "Successfully added.");
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
        $Specialization = Specialize::find($id);
        return view('admin.specialize.edit', compact('Specialization'));
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
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:5|max:200',
        ]);

        $Specialization = Specialize::find($id);
        $Specialization->title = $request->title;
        $Specialization->description = $request->description;
        $Specialization->status = $request->status == "" ? 0 : 1;
        $Specialization->save();
        return redirect()->route('admin.vet_specializes.index')->with('info', "Successfully update.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Specialize::find($id);
        $delete->delete();
        return redirect()->route('admin.vet_specializes.index')->with('danger', 'Successfully Deleted.');
    }
}
