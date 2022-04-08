<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador
        $role = Role::where('name','admin')->first();
        $user = User::where('email','admin@admin.com')->first();
        $user->roles()->attach($role);

        // Soporte
        $role = Role::where('name','support')->first();
        $user = User::where('email','support@admin.com')->first();
        $user->roles()->attach($role);

        // Entrenador
        $role = Role::where('name','coach')->first();
        $user = User::where('email','coach@admin.com')->first();
        $user->roles()->attach($role);


    }
}
