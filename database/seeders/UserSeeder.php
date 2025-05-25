<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pendaftaran',
            'email' => 'pendaftaran@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'pendaftaran'
        ]);

        User::create([
            'name' => 'Dr. Ahmad',
            'email' => 'dokter@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'dokter'
        ]);

        User::create([
            'name' => 'Suster Ani',
            'email' => 'perawat@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'perawat'
        ]);

        User::create([
            'name' => 'Apoteker Budi',
            'email' => 'apoteker@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'apoteker'
        ]);
    }
}
