<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 30;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('players')->insert([ //,
                'username' => $faker->userName,
                'firstname'=>$faker->firstName,
                'lastname'=>$faker->lastName,
                'password'=>$faker->password,
                'email' => $faker->unique()->email,
                'balance' => $faker->numberBetween($min = 10, $max = 9000),
                'opuser_id'=>1,
                'currency'=>'CNY',
                'created_at'=>$faker->dateTimeThisDecade($max = 'now')
            ]);
        }
    }
}
