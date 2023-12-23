<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Location::create([
            'address' => 'Pangasinan',
            'lat' => "15.9200001",
            'long' => "120.330002",
            'content' => null,
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'Alaminos City',
            'lat' => "16.1550",
            'long' => "119.9886",
            'content' => null,
            'status' => 1,
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'Dagupan City',
            'lat' => "16.0439",
            'long' => "120.3325",
            'content' => null,
            'status' => rand(0, 1),
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'San Carlos City',
            'lat' => "15.9522",
            'long' => "120.3467",
            'content' => null,
            'status' => rand(0, 1),
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'Urdaneta City',
            'lat' => "15.9766",
            'long' => "120.5717",
            'content' => null,
            'status' => rand(0, 1),
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'Lingayen',
            'lat' => "16.0210",
            'long' => "120.2319",
            'content' => null,
            'status' => rand(0, 1),
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
        Location::create([
            'address' => 'Calasiao',
            'lat' => "16.0080",
            'long' => "120.4169",
            'content' => null,
            'status' => rand(0, 1),
            'isOpen' => '1',
            'openHours' => '9am - 6pm',
            'daysOpen' => 'weekdays',
        ]);
    }
}
