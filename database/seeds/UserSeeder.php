<?php

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
        DB::table('users')->insert([
            'name' => 'Arief Purnama Muharram',
            'email' => 'ariefpurnamamuharram@gmail.com',
            'password' => Hash::make('arief13051997'),
        ]);
    }
}
