<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'role_user',
            'permission_user',
            'roles',
            'permissions',
            'statuses',
            'priorities',
            'channels',
            'positions',
            'task_types',
            'boards',
            'groups',
            'clients',
        ]);

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            StatusSeeder::class,
            PrioritySeeder::class,
            ChannelSeeder::class,
            PositionSeeder::class,
            TaskTypeSeeder::class,
            BoardSeeder::class,
            GroupSeeder::class
       ]);


    }

    // Limpia las tablas
    protected function truncateTables(array $tables) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Desactivamos la revisión de claves foráneas
    }
}
