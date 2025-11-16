<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder; 

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'phuongatb.23itb@vku.udn.vn',
            'password' => Hash::make('pianoweb@_@2005#'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin2',
            'email' => 'hattn.23itb@vku.udn.vn',
            'password' => Hash::make('pianoweb@_@2005?'),
            'role' => 'admin',
        ]);
        
    }
}
