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
            [
                "idunitkerja"=> 37,
                "nama"=>'LABKESDA',
                "username"=>'labkesda',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 38,
                "nama"=>'TANJUNGSARI',
                "username"=>'tanjungsari',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 39,
                "nama"=>'SIMOMULYO',
                "username"=>'simomulyo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 40,
                "nama"=>'MANUKANKULON',
                "username"=>'manukankulon',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 41,
                "nama"=>'BALONGSARI',
                "username"=>'balongsari',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 42,
                "nama"=>'ASEMROWO',
                "username"=>'asemrowo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 43,
                "nama"=>'SEMEMI',
                "username"=>'sememi',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 44,
                "nama"=>'BENOWO',
                "username"=>'benowo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 45,
                "nama"=>'JERUK',
                "username"=>'jeruk',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 46,
                "nama"=>'LIDAHKULON',
                "username"=>'lidahkulon',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 47,
                "nama"=>'LONTAR',
                "username"=>'lontar',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 48,
                "nama"=>'PENELEH',
                "username"=>'peneleh',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 49,
                "nama"=>'KETABANG',
                "username"=>'ketabang',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 50,
                "nama"=>'KEDUNGDORO',
                "username"=>'kedungdoro',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 51,
                "nama"=>'DRSOETOMO',
                "username"=>'drsoetomo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 52,
                "nama"=>'TEMBOKDUKUH',
                "username"=>'tembokdukuh',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 53,
                "nama"=>'GUNDIH',
                "username"=>'gundih',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 54,
                "nama"=>'TAMBAKREJO',
                "username"=>'tambakrejo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 55,
                "nama"=>'SIMOLAWANG',
                "username"=>'simolawang',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 56,
                "nama"=>'PERAKTIMUR',
                "username"=>'peraktimur',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 57,
                "nama"=>'PEGIRIAN',
                "username"=>'pegirian',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 58,
                "nama"=>'SIDOTOPO',
                "username"=>'sidotopo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 59,
                "nama"=>'WONOKUSUMO',
                "username"=>'wonokusumo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 60,
                "nama"=>'KREMBANGANSELATAN',
                "username"=>'krembanganselatan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 61,
                "nama"=>'DUPAK',
                "username"=>'dupak',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 62,
                "nama"=>'KENJERAN',
                "username"=>'kenjeran',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 63,
                "nama"=>'TAKAL',
                "username"=>'takal',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 64,
                "nama"=>'SIDOTOPOWETAN',
                "username"=>'sidotopowetan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 65,
                "nama"=>'RANGKAH',
                "username"=>'rangkah',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 66,
                "nama"=>'PACARKELING',
                "username"=>'pacarkeling',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 67,
                "nama"=>'GADING',
                "username"=>'gading',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 68,
                "nama"=>'PUCANGSEWU',
                "username"=>'pucangsewu',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 69,
                "nama"=>'MOJO',
                "username"=>'mojo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 70,
                "nama"=>'KALIRUNGKUT',
                "username"=>'kalirungkut',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 71,
                "nama"=>'MEDOKANAYU',
                "username"=>'medokanayu',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 72,
                "nama"=>'TENGGILIS',
                "username"=>'tenggilis',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 73,
                "nama"=>'GUNUNGANYAR',
                "username"=>'gununganyar',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 74,
                "nama"=>'MENUR',
                "username"=>'menur',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 75,
                "nama"=>'KLAMPISNGASEM',
                "username"=>'klampisngasem',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 76,
                "nama"=>'MULYOREJO',
                "username"=>'mulyorejo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 77,
                "nama"=>'SAWAHAN',
                "username"=>'sawahan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 78,
                "nama"=>'PUTATJAYA',
                "username"=>'putatjaya',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 79,
                "nama"=>'BANYUURIP',
                "username"=>'banyuurip',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 80,
                "nama"=>'PAKIS',
                "username"=>'pakis',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 81,
                "nama"=>'JAGIR',
                "username"=>'jagir',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 82,
                "nama"=>'WONOKROMO',
                "username"=>'wonokromo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 83,
                "nama"=>'NGAGELREJO',
                "username"=>'ngagelrejo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 84,
                "nama"=>'KEDURUS',
                "username"=>'kedurus',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 85,
                "nama"=>'DUKUHKUPANG',
                "username"=>'dukuhkupang',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 86,
                "nama"=>'WIYUNG',
                "username"=>'wiyung',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 87,
                "nama"=>'GAYUNGAN',
                "username"=>'gayungan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 88,
                "nama"=>'JEMURSARI',
                "username"=>'jemursari',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 89,
                "nama"=>'SIDOSERMO',
                "username"=>'sidosermo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 90,
                "nama"=>'KEBONSARI',
                "username"=>'kebonsari',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 103,
                "nama"=>'BANGKINGAN',
                "username"=>'bangkingan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 104,
                "nama"=>'MADE',
                "username"=>'made',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 117,
                "nama"=>'MOROKREMBANGAN',
                "username"=>'morokrembangan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 121,
                "nama"=>'TAMBAKWEDI',
                "username"=>'tambakwedi',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 122,
                "nama"=>'BULAKBANTENG',
                "username"=>'bulakbanteng',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 135,
                "nama"=>'KEPUTIH',
                "username"=>'keputih',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 138,
                "nama"=>'KALIJUDAN',
                "username"=>'kalijudan',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 148,
                "nama"=>'BALASKLUMPRIK',
                "username"=>'balasklumprik',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 151,
                "nama"=>'SIWALANKERTO',
                "username"=>'siwalankerto',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
            [
                "idunitkerja"=> 984,
                "nama"=>'SAWAHPULO',
                "username"=>'sawahpulo',
                "role"=>'PKM',
                "password"=> Hash::make('12345')
            ],
        ]);
    }
}
