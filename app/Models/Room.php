<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function cities() {
        return $this->belongsToMany('App\Models\City')->withPivot('created_at', 'updated_at')->using('App\Models\CityRoom');
    }

    public function comments() {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function likes() {
        return $this->morphToMany('App\Models\User', 'likeable');
    }
}
