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
        /*
         * Modify this variable to add new user.
         * Flush the database using php artisan db:seed --class=UserSeeder command.
         */
        $users = [
            [
                'name' => 'Arief Purnama Muharram',
                'email' => 'ariefpurnamamuharram@gmail.com',
                'password' => '11223344',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
