<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Gcash;
use App\Models\Location;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $yearly_income = DB::table('gcashes')
        //     ->whereYear('created_at', Carbon::now()->format('Y'))
        //     ->where('status', '1')
        //     ->SUM('amount');
        $users = User::where('status', '1')->count();
        $gcash = Gcash::where('status', '1')->count();
        $locations = Location::where('status', '1')->count();
        $medicalRecords = MedicalRecord::count();

        //postgresql
        // $bookings = DB::table('bookings')
        //     ->select(DB::raw("to_char(created_at, 'YYYY-MM') as month"), DB::raw('COUNT(*) as total'))
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();

        // mysql
        $bookings = DB::table('bookings')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $bookings->transform(function ($item) {
            $item->month = Carbon::createFromFormat('Y-m', $item->month)->format('M Y');
            return $item;
        });

        return view('admin.dashboard', compact('medicalRecords', 'users', 'gcash', 'locations', 'bookings'));
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
