<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(500),
            'user_id' => $this->faker->numberBetween(1, 5000),
            'rating' => $this->faker->numberBetween(1, 5),
            'commentable_type' => $this->faker->randomElement(['App\Models\Room', 'App\Models\Image']),
            'commentable_id' => $this->faker->numberBetween(1,600)
        ];
    }
}
