<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        for ($i=0; $i<20; $i++) {
            $newUser = User::create(array(
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt($faker->word)
            ));
            $newUser->assignRole(1);
            $newUser->save();
        }
    }

}