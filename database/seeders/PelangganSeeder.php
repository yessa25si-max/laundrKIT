<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggans = [
            [
                'first_name' => 'Budi',
                'last_name' => 'Santoso',
                'birthday' => '1992-04-12',
                'gender' => 'Male',
                'email' => 'budi.santoso@gmail.com',
                'phone' => '081234567890',
            ],
            [
                'first_name' => 'Siti',
                'last_name' => 'Nurhaliza',
                'birthday' => '1996-08-25',
                'gender' => 'Female',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '082198765432',
            ],
            [
                'first_name' => 'Ahmad',
                'last_name' => 'Fauzi',
                'birthday' => '1988-11-03',
                'gender' => 'Male',
                'email' => 'ahmad.fauzi@yahoo.com',
                'phone' => '085712348765',
            ],
            [
                'first_name' => 'Dewi',
                'last_name' => 'Anggraini',
                'birthday' => '2000-02-14',
                'gender' => 'Female',
                'email' => 'dewi.anggraini@outlook.com',
                'phone' => '081399887766',
            ],
            [
                'first_name' => 'Rian',
                'last_name' => 'Hidayat',
                'birthday' => '1994-07-19',
                'gender' => 'Male',
                'email' => 'rian.hidayat@gmail.com',
                'phone' => '087811223344',
            ],
            [
                'first_name' => 'Melati',
                'last_name' => 'Kusuma',
                'birthday' => '1998-10-30',
                'gender' => 'Female',
                'email' => 'melati.kusuma@gmail.com',
                'phone' => '085699881122',
            ],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::updateOrCreate(['email' => $pelanggan['email']], $pelanggan);
        }
    }
}
