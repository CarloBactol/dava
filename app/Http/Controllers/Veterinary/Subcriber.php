<?php

namespace App\Http\Controllers\Veterinary;

use App\Models\Gcash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Subcriber extends Controller
{
    public function index()
    {
        $paid = Gcash::all();
        return view('veterinary.gcash.index', compact('paid'));
    }
}
