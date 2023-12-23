<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::create([
            'branch' => 'Dagupan City',
            'status' => 'Pending',
            'services' => 'Dental Care',
            'type' => 'walk-in',
            'email' => 'johndeo@email.com',
            'address' => 'Caloocan City',
            'date' => '2023-11-11',
            'start' => '14:00',
            'end' => '15:00',
        ]);
        Booking::create([
            'branch' => 'Dagupan City',
            'status' => 'Pending',
            'services' => 'Dental Care',
            'type' => 'walk-in',
            'email' => 'carlo@email.com',
            'address' => 'Caloocan City',
            'date' => '2023-11-11',
            'start' => '16:00',
            'end' => '20:00',
        ]);
    }
}
