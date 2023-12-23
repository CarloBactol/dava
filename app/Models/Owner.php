<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $table = 'owners';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'email',
        'branch',
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'owner_id');
    }
}
