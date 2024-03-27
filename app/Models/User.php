<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function aluno() {
        return $this->hasOne('\App\Models\Aluno');
    }

    public function role() {
        return $this->belongsTo('\App\Models\Role');
    }

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }

    public function comprovante() {
        return $this->hasMany('\App\Models\Comprovante');
    }
}