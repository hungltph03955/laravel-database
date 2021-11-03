<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\User::class,3)->create();
        User::factory()->count(6000)->create();
//        $connection = "sqlite";
        $users = User::factory()->count(6000)->make();
//        $users->each(function($model) use ($connection) {
//            $model->setConnection($connection);
//            $model->save();
//        });
    }
}
