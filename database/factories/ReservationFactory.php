<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5000),
            'room_id' => $this->faker->numberBetween(1, 300),
            'city_id' => $this->faker->numberBetween(1, 300),
            'check_in' => $this->faker->dateTimeBetween('-10 days', 'now'),
            'check_out' => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }
}
