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
        // static::retrieved(function($comment) {
        //     echo $comment->rating;
        // });
        static::addGlobalScope('rating', function(Builder $builder) {
            $builder->where('rating', '>', 2);
        });
    }


    public function scopeRating($query, int $value = 4) {
        return $query->where('rating', '>', $value);
    }

    public function getRatingAttribute($value) {
        return $value + 10;
    }

    public function getWhoWhatAttribute() {
        return "user {$this->user_id} rate {$this->rating}";
    }

    public function setRatingAttribute($value) {
        $this->attributes['rating'] = $value + 1;
    }

    protected $cast = [
        'rating' => 'float',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
