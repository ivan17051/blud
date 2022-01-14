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
                "nama" => "mas somay",
                "idunitkerja" => "1",
                "username" => "somay",
                "password" => Hash::make('password'),
                "role" => "admin"
            ],
            [
                "nama" => "RM Ivan",
                "idunitkerja" => "1",
                "username" => "ivan",
                "password" => Hash::make('password'),
                "role" => "admin"
            ],
            [
                "nama" => "siannas",
                "idunitkerja" => "1",
                "username" => "siannas",
                "password" => Hash::make('admin'),
                "role" => "admin"
            ], 
        ]);
    }
}
