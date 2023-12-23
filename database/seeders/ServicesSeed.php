<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Vaccination and Preventive Care',
            'description' => 'Providing vaccinations, regular check-ups, and wellness exams for pets to prevent common diseases and ensure overall health',
            'status' => '1'
        ]);
        Service::create([
            'name' => 'Dental Care for Pets',
            'description' => 'Offering dental cleanings, extractions, and treatment of oral health issues in dogs and cats, promoting better oral hygiene and overall well-being',
            'status' => '1'
        ]);
        Service::create([
            'name' => 'Large Animal Herd Health Programs',
            'description' => 'Implementing herd health management plans for livestock, which include vaccination, nutrition, and disease prevention strategies to maintain the health of large animal populations',
            'status' => '1'
        ]);

        Service::create([
            'name' => 'Diagnostic Imaging',
            'description' => 'Utilizing diagnostic imaging techniques like X-rays and ultrasound to diagnose and monitor conditions in animals, aiding in the development of treatment plans.',
            'status' => '1'
        ]);
        Service::create([
            'name' => 'Wildlife Rehabilitation',
            'description' => 'Caring for injured or orphaned wildlife, providing medical treatment, and aiding in their rehabilitation and release back into their natural habitats, contributing to wildlife conservation efforts.',
            'status' => '1'
        ]);
    }
}
