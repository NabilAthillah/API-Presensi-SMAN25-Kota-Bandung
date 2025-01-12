<?php

namespace Database\Seeders;

use App\Models\Teachers;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teachers::create([
            'nip' => '000000000000000000',
            'name' => 'Administrator SMAN 25 Kota Bandung',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminsman25kotabandung'),
            'address' => 'SMAN 25 Kota Bandung',
            'phone_number' => '000000000000',
            'role' => 'administrator',
        ]);
    }
}
