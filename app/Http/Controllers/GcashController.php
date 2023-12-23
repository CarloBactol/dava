<?php

namespace App\Http\Controllers;

use App\Models\Gcash;
use App\Models\GcashNumber;
use Illuminate\Http\Request;

class GcashController extends Controller
{
    public function gcash_payment(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required',
            'amount' => 'required|max:20',
            'phone_no' => 'required',
            'reference_no' => 'required',
        ]);


        // create users
        $payment = Gcash::create([
            'email' => $attr['email'],
            'phone_no' => $attr['phone_no'],
            'amount' => $attr['amount'],
            'reference_no' => $attr['reference_no'],
            'status' => '0',
        ]);

        return response([
            'payment' => $payment,
        ]);
    }

    public function payments()
    {
        $gcash = Gcash::orderBy('created_at', 'ASC')->get();
        return response([
            'payment' => $gcash,
        ]);
    }


    public function getUserEmail(Request $request)
    {
        $gcash = Gcash::where('email', '=', $request->email)->first();
        return response([
            'status' => $gcash->status,
        ]);
    }

    public function getAccount(Request $request)
    {
        $account = GcashNumber::where('status', '1')->first();
        return response([
            'account' => $account,
        ]);
    }
}
