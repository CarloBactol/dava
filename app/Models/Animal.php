<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animals';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'species',
        'breed',
        'name',
        'date_of_birth',
        'gender',
        'color',
        'owner_id'
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'animal_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'animal_id');
    }
}
