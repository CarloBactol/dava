<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinary extends Model
{
    use HasFactory;
    protected $table = 'veterinaries';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
        'specialization',
        'address',
        'phone_number',
        'email',
        'status',
        'branch',
    ];

    public function specializations()
    {
        return $this->hasMany(Specialization::class, 'vet_id');
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'vet_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'vet_id');
    }
}
