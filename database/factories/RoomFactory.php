<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_number' => $this->faker->unique(true)->numberBetween(1, 30),
            'room_size' => $this->faker->numberBetween(1, 300),
            'price' => $this->faker->numberBetween(100, 600),
            'description' => $this->faker->text(1000)
        ];
    }
}
