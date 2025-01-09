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
        if (!User::where('email', 'aasgestao@gmail.com')->first()) {
            $superAdmin = User::create([
                'name' => 'André',
                'email' => 'aasgestao@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
                'perfil' => 'Super Admin',
            ]);

            
        }
        
        

    }
}
