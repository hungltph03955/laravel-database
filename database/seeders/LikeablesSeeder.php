<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LikeablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 300; $i++) {
            DB::table('likeables')->insert([
                'likeable_type' => ['App\Models\Image', 'App\Models\Room'][mt_rand(0,1)],
                'likeable_id' => mt_rand(1,10),
                'user_id' => mt_rand(1, 3),
            ]);
        }
    }
}
