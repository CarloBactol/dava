<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;
    protected $fillable = ['consumption', 'patient_id', 'quantity'];
    protected $table = 'consumptions';

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'patient_id')->withDefault(true);
    }
}
