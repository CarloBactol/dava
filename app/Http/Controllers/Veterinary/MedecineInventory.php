<?php

namespace App\Http\Controllers\Veterinary;

use App\Models\Medecine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class MedecineInventory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medecine = Medecine::all();
        return view('veterinary.medecine.index', compact('medecine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veterinary.medecine.create');
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
            'name' => 'required|min:5|max:40|string|unique:medecines,name',
            'quantity' => 'required|min:1|max:10000|numeric',
            'description' => 'required|min:5|max:300|string',
        ]);

        Medecine::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => $request->status == '' ? 0 : 1,
        ]);

        return redirect()->route('veterinary.medecine_inventories.index')->with('success', 'Successfully added.');
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
        $medecine = Medecine::findOrFail($id);
        return view('veterinary.medecine.edit', compact('medecine'));
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
            'name' => 'required|min:5|max:40|string|unique:medecines,name,' . $id,
            'quantity' => 'required|min:1|max:10000|numeric',
            'description' => 'required|min:5|max:300|string',
        ]);

        $update = Medecine::findOrFail($id);
        $update->name = $request->name;
        $update->quantity = $request->quantity;
        $update->description = $update->description;
        $update->status = $request->status == '' ? 0 : 1;
        $update->save();

        return redirect()->route('veterinary.medecine_inventories.index')->with('info', 'Successfully update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Medecine::find($id);
        $delete->delete();
        return redirect()->route('veterinary.medecine_inventories.index')->with('danger', 'Successfully Deleted.');
    }
}
