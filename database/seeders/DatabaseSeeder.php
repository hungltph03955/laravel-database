<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(CityRoomSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(LikeablesSeeder::class);
    }
}
