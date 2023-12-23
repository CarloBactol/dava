<?php

namespace App\Http\Controllers\Veterinary;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gcash;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VetDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gcash = DB::table('gcashes')
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->where('status', '1')
            ->sum('amount');
        $medical = DB::table('medical_records')
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->where('status', '1')
            ->sum('cost');


        $yearly_income = $gcash + $medical;

        $users = User::where('status', '1')->count();
        $gcash = Gcash::where('status', '1')->count();
        $locations = Location::where('status', '1')->count();
        $medicalRecords = MedicalRecord::count();
        return view('veterinary.dashboard.dashboard', compact('yearly_income', 'medicalRecords', 'users', 'gcash', 'locations'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
