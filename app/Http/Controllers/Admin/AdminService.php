<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminService extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::orderBy('name', 'ASC')->get();
        return view('admin.service.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'name' => 'required|string|min:2|max:40',
            'description' => 'required|string|min:10|max:200',
        ]);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status == "" ? 1 : 0,
        ]);

        return redirect()->route('admin.admin_services.index')->with('success', "Successfully Added.");
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
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
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
            'name' => 'required|string|min:2|max:30',
            'description' => 'required|string|min:10|max:200',
        ]);


        $update_Service = Service::find($id);
        $update_Service->name = $request->name;
        $update_Service->description = $request->description;
        $update_Service->status = $request->status == "" ? 0 : 1;
        $update_Service->save();
        return redirect()->route('admin.admin_services.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $del_Services = Service::find($id);
        $del_Services->delete();
        return redirect()->route('admin.admin_services.index')->with('success', 'Successfully Deleted.');
    }
}
