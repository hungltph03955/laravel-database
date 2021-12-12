<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=200; $i++) {
            DB::table('city_room')->insert([
                'city_id' => mt_rand(1,300),
                'room_id' => mt_rand(1,300),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
