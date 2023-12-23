<?php

namespace Database\Seeders;

use App\Models\Gcash;
use Illuminate\Database\Seeder;

class GcashPayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gcash::create([
            'email' => 'test@example.com',
            'amount' => '1000',
            'phone_no' => '08999999999',
            'reference_no' => '0899999999900',
            'status' => '1',
        ]);
        Gcash::create([
            'email' => 'test2@example.com',
            'amount' => '1000',
            'phone_no' => '08999999988',
            'reference_no' => '0899999999911',
            'status' => '1',
        ]);
    }
}
