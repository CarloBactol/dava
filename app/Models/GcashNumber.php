<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GcashNumber extends Model
{
    use HasFactory;
    protected $table = 'gcash_numbers';
    protected $fillable = ['account_name', 'cost', 'account_number', 'status'];
}
