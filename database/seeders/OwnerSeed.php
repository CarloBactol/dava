<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '09514384264',
            'email' => 'john@email.com',
            'address' => '#66 Callejon II Purok 6 Pasig City',
            'status' => 1,
        ]);

        Owner::create([
            'first_name' => 'Carlo',
            'last_name' => 'Pamor',
            'phone_number' => '09513384264',
            'email' => 'carlo@email.com',
            'address' => '#66 Callejon II Purok 6 Pasig City',
            'status' => 0,
        ]);
    }
}
