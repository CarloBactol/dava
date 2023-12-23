<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function animal(Request $request)
    {

        $animal = Animal::where('owner_id', $request->owner_id)->get();
        return response(['pets' => $animal], 200);
    }

    public function medical_records(Request $request)
    {

        $medical = Animal::with([
            'medicalRecords',
            'medicalRecords.veterinarian:id,email as veterinarian_email',
            'owner:id,email as owner_email'
        ])
            ->where('owner_id', $request->id)
            ->get();

        return response(['animals' => $medical], 200);
    }
}
