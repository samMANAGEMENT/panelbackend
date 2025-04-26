<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@suitpress.com',
            'password' => Hash::make('TkNAZ1X.'),
        ]);
        
        Status::create([
            'nombre' => 'Cargando',
        ]);

        Status::create([
            'nombre' => 'Login',
        ]);

        Status::create([
            'nombre' => 'Error-Login',
        ]);

        Status::create([
            'nombre' => 'ATM',
        ]);

        Status::create([
            'nombre' => 'Otp',
        ]);

        Status::create([
            'nombre' => 'Error-Otp',
        ]);
    }
}
