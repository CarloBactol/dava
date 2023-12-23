<?php

namespace Database\Seeders;

use App\Models\Medecine;
use Illuminate\Database\Seeder;

class MedecineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medecine::create([
            'name' => 'Antibiotics',
            'description' => 'Used to treat bacterial infections in animals. Examples include amoxicillin, ciprofloxacin, and tetracycline.',
            'quantity' => 10,
            'status' => 1,
        ]);
        Medecine::create([
            'name' => 'Antiparasitics',
            'description' => 'Medications to treat internal and external parasites such as worms, fleas, ticks, and mites. Common antiparasitic drugs include ivermectin, fenbendazole, and fipronil.',
            'quantity' => 10,
            'status' => 1,
        ]);
        Medecine::create([
            'name' => 'Pain Medications',
            'description' => 'Pain relief is important in veterinary care. Options include carprofen, meloxicam, and tramadol.',
            'quantity' => 10,
            'status' => 1,
        ]);
        Medecine::create([
            'name' => 'Vaccines',
            'description' => 'Vaccination is essential for preventing various diseases in animals, including rabies, distemper, and parvovirus.',
            'quantity' => 10,
            'status' => 1,
        ]);
        Medecine::create([
            'name' => 'Heartworm Preventatives',
            'description' => 'These medications, such as ivermectin, are administered regularly to prevent heartworm infections.',
            'quantity' => 10,
            'status' => 1,
        ]);
        Medecine::create([
            'name' => 'Anesthetics',
            'description' => 'Medications used for surgical procedures and sedation. Options include isoflurane and propofol.',
            'quantity' => 10,
            'status' => 1,
        ]);
    }
}
