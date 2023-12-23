<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $table = 'medical_records';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['vet_id', 'animal_id', 'procedure', 'type_of_procedure', 'cost', 'notes'];

    public function veterinarian()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
