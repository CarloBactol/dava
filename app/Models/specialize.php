<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialize extends Model
{
    use HasFactory;
    protected $table = 'specializes';
    protected $fillable = ['title', 'description', 'status'];
}
