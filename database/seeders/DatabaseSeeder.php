<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(LocationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ServicesSeed::class);
        $this->call(AccountGcashSeeder::class);
        $this->call(SpecializeSeeder::class);
        $this->call(MedecineSeeder::class);
        // $this->call(BookingSeeder::class);
    }
}
