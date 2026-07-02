<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Cast Attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User memiliki banyak hasil quiz
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    /**
     * User memiliki satu progress
     */
    public function progress()
    {
        return $this->hasOne(Progress::class);
    }

    /**
     * User memiliki banyak rekomendasi
     */
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
