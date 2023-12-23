<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gcash extends Model
{
    use HasFactory;
    protected $table = 'gcashes';
    protected $fillable = ['email', 'amount', 'phone_no', 'reference_no', 'status'];
}
