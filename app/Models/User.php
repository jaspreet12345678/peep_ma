<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'ecole', // Add ecole_id to fillable array
        'role',  // Add role_id to fillable array
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    // public $timestamps = false;

    public function ecole()
    {
        return $this->belongsTo(Ecole::class); // Assuming User belongs to one Ecole
    }

    public function role()
    {
        return $this->belongsTo(Role::class); // Assuming User belongs to one Role
    }
}
