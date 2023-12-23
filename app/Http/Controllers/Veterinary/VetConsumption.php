<?php

namespace App\Http\Controllers\Veterinary;

use App\Models\User;
use App\Models\Animal;

use App\Models\Medecine;
use Faker\Provider\Medical;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consumption;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class VetConsumption extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumption = Consumption::all();
        return view('veterinary.consumption.index', compact('consumption'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animal = Animal::orderby('name', 'asc')
            ->get();
        $medecine = Medecine::where('status', '1')->get();
        $vet = User::orderby('email', 'asc')->where('status', '1')
            ->where('email', Auth::user()->email)
            ->first();

        Cart::destroy();
        $cartItems = Cart::content();
        return view('veterinary.consumption.create', compact('medecine', 'cartItems', 'animal', 'vet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartItem = Cart::count();
        if ($cartItem == 0) {
            return redirect()->back()->with('message', 'No item added!');
        }

        $cart = Cart::content();
        foreach ($cart as $value) {
            $getQty = Medecine::where('id', $value->id)->first();
            $totalQty = $getQty->quantity - $value->qty;
            $data = Medecine::find($value->id);
            $data->quantity =  $totalQty;
            $data->update();

            Consumption::create([
                'patient_id' => $request->id,
                'quantity' => $value->qty,
                'consumption' =>  $value->name
            ]);
        }

        return response()->json(['message' => 'successfully added']);
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
        $delete = Consumption::find($id);
        $delete->delete();
        return redirect()->route('veterinary.vet_consumptions.index')->with('danger', 'Successfully Deleted.');
    }
}
