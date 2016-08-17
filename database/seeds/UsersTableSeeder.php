<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('users')->insert([ //,
                'name' => 'dummyuser',
                'password'=>Hash::make('secret'),
                'email' => 'test4@e8bet',

            ]);
    }
}
