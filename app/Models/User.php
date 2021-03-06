<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $wiith = ['address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'comments'
        'email',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'meta' => 'json'
    ];

    public function address() {
        return $this->hasOne('App\Models\Address', 'user_id', 'id');
        // ->withDefault([
        //     'country' => 'no addrees attached yet'
        // ])
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    public function image() {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function likedImages() {
        return $this->morphedByMany('App\Models\Image', 'likeable');
    }

    public function likedRooms() {
        return $this->morphedByMany('App\Models\Room', 'likeable');
    }
}
