<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'ako',
            'email' => 'admin@email.com',
            'password' => Hash::make('adminpass'),
            'role' => 'super_admin',
            'status' => '1',
            'address' => 'Pasig City',
            'phone_number' => '09789800022',
            'specialize_id' => '1',
            'branch' => 'Alaminos City',
        ]);

        User::create([
            'first_name' => 'branchManager',
            'last_name' => 'branch',
            'email' => 'branchmanager@email.com',
            'password' => Hash::make('adminpass'),
            'role' => 'branch_admin',
            'status' => '1',
            'address' => 'Pasig City',
            'phone_number' => '09789801011',
            'specialize_id' => '1',
            'branch' => 'Alaminos City',

        ]);

        //an array of all parents' ids
        $parent_ids = ['1', '2', '3'];
        $location = Location::where('status', 1)->pluck('address');

        $faker1 = \Faker\Factory::create();
        $faker2 = \Faker\Factory::create();
        $numberOfVeterinarian = $faker1->numberBetween(1, 5);
        $numberOfClient = $faker2->numberBetween(1, 10);

        // for ($i = 0; $i < $numberOfVeterinarian; $i++) {
        //     User::firstOrCreate([
        //         'first_name' => $faker1->firstName,
        //         'last_name' => $faker1->lastName,
        //         'email' => $faker1->email,
        //         'password' => Hash::make('adminpass'),
        //         'role' => 'veterinarian',
        //         'status' => '1',
        //         'address' => $faker1->address,
        //         'phone_number' => $faker1->numerify('09#########'),
        //         'specialize_id' => '',
        //         'branch' => $faker1->randomElement($location),
        //     ]);
        // }

        for ($i = 0; $i < $numberOfClient; $i++) {
            User::firstOrCreate([
                'first_name' => $faker2->firstName,
                'last_name' => $faker2->lastName,
                'email' => $faker2->email,
                'password' => Hash::make('adminpass'),
                'role' => 'client',
                'status' => '1',
                'address' => $faker2->address,
                'phone_number' => $faker1->numerify('09#########'),
                'specialize_id' => '',
                'branch' =>  $faker2->randomElement($location),
            ]);
        }
    }
}
