<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::retrieved(function($comment) {
            echo $comment->rating->limit(10);
        });
        // static::addGlobalScope('rating', function(Builder $builder) {
        //     $builder->where('rating', '>', 2);
        // });
    }


    public function scopeRating($query, int $value = 4) {
        return $query->where('rating', '>', $value);
    }

}
