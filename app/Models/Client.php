<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class Client extends Model
class Client extends Authenticatable implements JWTSubject
{
    // use HasFactory;
    protected $guard = 'client';

    protected $fillable = ['name', 'email', 'password', 'description', 'image', 'birthdate', 'mother', 'father', 'number_phone', 'instagram'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function love_story()
    {
        return $this->hasMany(Love_story::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class, "client_id", "id");
    }

    public function bestfriend()
    {
        return $this->hasMany(Bestfriend::class);
    }
}
