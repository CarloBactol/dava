<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAppointment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == "super_admin") {
            $bookings = Booking::all();
            return view('admin.appoitments.index', compact('bookings'));
        } elseif (Auth::user()->role == "branch_admin") {
            $bookings = Booking::where('branch', Auth::user()->branch)->get();
            return view('admin.appoitments.index', compact('bookings'));
        } else {
            return redirect()->route('admin.admin_dashboards.index')->with('warning', "You are not allowed to access this page.");
        }
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
        $userBook = Booking::find($id);
        return view('admin.appoitments.show', compact('userBook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userBook = Booking::find($id);
        // dd($userBook);
        return view('admin.appoitments.edit', compact('userBook'));
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
        $userBook = Booking::find($id);
        $userBook->status = $request->status;
        $userBook->message = $request->message;
        $userBook->save();

        return redirect()->route('admin.user_appoitments.index')->with('info', 'Successfully updated.');
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
