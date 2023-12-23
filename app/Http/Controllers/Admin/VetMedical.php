<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Animal;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VetMedical extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $med_rec = MedicalRecord::orderby('created_at', 'desc')
            ->get();
        return view('admin.medical.index', compact('med_rec'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::orderBy('name', 'ASC')->where('status', '1')->get();
        // $vet = User::orderby('email', 'asc')->where('status', '1')
        //     ->where('email', Auth::user()->email)
        //     ->first();

        $vet = User::where('role', 'veterinarian')
            ->where('branch', Auth::user()->branch)
            ->get();

        $animal = Animal::orderby('name', 'asc')
            ->get();

        return view('admin.medical.create', compact('vet', 'animal', 'services'));
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
            'vet_id' => 'required',
            'animal_id' => 'required',
            'type_of_procedure' => 'required',
            'procedure' => 'required',
            'cost' => 'required|numeric',
        ]);

        MedicalRecord::create([
            'vet_id' => $request->vet_id,
            'animal_id' => $request->animal_id,
            'procedure' => $request->procedure,
            'type_of_procedure' => $request->type_of_procedure,
            'cost' => $request->cost,
            'notes' => $request->notes,
        ]);
        return redirect()->route('admin.medicals.index')->with('success', "Successfully Added.");
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
        $services = Service::orderBy('name', 'ASC')->where('status', '1')->get();
        $vet = User::where('role', 'veterinarian')
            ->where('branch', Auth::user()->branch)
            ->get();
        $animal = Animal::orderby('name', 'asc')
            ->get();
        $med = MedicalRecord::find($id);
        return view('admin.medical.edit', compact('med', 'animal', 'services', 'vet'));
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
            'procedure' => 'required',
            'type_of_procedure' => 'required',
            'cost' => 'required|numeric',
        ]);

        $med = MedicalRecord::find($id);
        $med->vet_id = $request->vet_id;
        // $med->animal_id = $request->animal_id;
        $med->procedure = $request->procedure;
        $med->type_of_procedure = $request->type_of_procedure;
        $med->cost = $request->cost;
        $med->notes = $request->notes;
        $med->save();
        return redirect()->route('admin.medicals.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = MedicalRecord::find($id);
        $delete->delete();
        return redirect()->route('admin.medicals.index')->with('danger', 'Successfully Delete');
    }
}
