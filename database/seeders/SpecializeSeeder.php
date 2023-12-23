<?php

namespace Database\Seeders;

use App\Models\specialize;
use Illuminate\Database\Seeder;

class SpecializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        specialize::create([
            'title' => 'Board-Certified Small Animal Dentistry Specialist',
            'description' => 'These veterinarians specialize in advanced dental procedures and oral surgery for dogs and cats, addressing complex dental issues and promoting oral health.',
            'status' => '1'
        ]);
        specialize::create([
            'title' => 'Bovine Herd Health Veterinarian',
            'description' => 'Specializing in the health management and care of cattle, these veterinarians focus on the well-being of herds, including disease prevention, reproduction, and nutrition.',
            'status' => '1'
        ]);
        specialize::create([
            'title' => 'Equine Reproductive Specialist',
            'description' => 'Experts in equine reproduction, they provide services related to mare and stallion reproductive health, artificial insemination, and embryo transfer in horses.',
            'status' => '1'
        ]);
        specialize::create([
            'title' => 'Diagnostic Imaging Radiologist',
            'description' => 'Veterinarians who specialize in interpreting and performing advanced diagnostic imaging, such as radiographs (X-rays), MRI, and CT scans for accurate diagnoses.',
            'status' => '1'
        ]);
        specialize::create([
            'title' => 'Wildlife Veterinarian',
            'description' => 'Specializing in the medical care of wildlife species, these veterinarians provide care for injured, ill, or endangered animals, often working in wildlife rehabilitation centers, zoos, or with conservation organizations.',
            'status' => '1'
        ]);
    }
}
