<?php

namespace App\Models;

use App\Models\Animal;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'branch',
        'role',
        'status',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'specialize_id',
    ];

    // public function specialization()
    // {
    //     return $this->belongsTo(specialize::class, 'specialize_id', 'id')->withDefault(true);
    // }

    public function animals()
    {
        return $this->hasMany(Animal::class, 'owner_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
