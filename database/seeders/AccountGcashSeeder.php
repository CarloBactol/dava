<?php

namespace Database\Seeders;

use App\Models\GcashNumber;
use Illuminate\Database\Seeder;

class AccountGcashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GcashNumber::create([
            'account_name' => 'DAVAS',
            'account_number' => '09513384264',
            'cost' => '500',
            'status' => '1'
        ]);
    }
}
