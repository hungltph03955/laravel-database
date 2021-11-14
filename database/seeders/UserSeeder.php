<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
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

        User::factory()->count(6000)->create()->each(function($user) {
            // $user->address()->save(factory(Address::class)->make());
            $user->address()->save(Address::factory()->make());
        });



//        $connection = "sqlite";
        // $users = User::factory()->count(6000)->make();
//        $users->each(function($model) use ($connection) {
//            $model->setConnection($connection);
//            $model->save();
//        });
    }
}
