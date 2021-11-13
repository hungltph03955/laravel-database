<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope('rating', function(Builder $builder) {
            $builder->where('rating', '>', 2);
        });
    }


    public function scopeRating($query, int $value = 4) {
        return $query->where('rating', '>', $value);
    }

}
