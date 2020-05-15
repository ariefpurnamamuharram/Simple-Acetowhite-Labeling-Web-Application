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
            'password' => Hash::make('11223344'),
        ]);

        DB::table('users')->insert([
            'name' => 'CerviCam',
            'email' => 'cervicam.indonesia@gmail.com',
            'password' => Hash::make('CerviCam2020@IMERI')
        ]);
    }
}
