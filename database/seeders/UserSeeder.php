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
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'name' => 'Administrador General',
			'email' => 'admin@admin.com',
            'phone'     => '1111111111',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
			'name' => 'Soporte General',
			'email' => 'support@admin.com',
            'phone'     => '0911911911',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
			'name' => 'Coach Ejemplo',
			'email' => 'coach@admin.com',
            'phone'     => '9999999999',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

    }
}
