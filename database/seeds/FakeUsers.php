<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakeUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'nombre' => str_random(10),
        'apellido' => str_random(10),
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('secret'),
]);
    }
}
