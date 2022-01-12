<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\User::insert([
            [
                "nama" => "RM Ivan",
                "idunitkerja" => "1",
                "username" => "ivan",
                "password" => Hash::make('password'),
                "role" => "admin"
            ]
        ]);
    }
}
