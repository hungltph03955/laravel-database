<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function reservations() {
        return $this->hasManyThrough('App\Models\Reservation', 'App\Models\User', 'company_id', 'user_id', 'id', 'id');
    }
}
