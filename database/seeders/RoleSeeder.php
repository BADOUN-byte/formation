<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(
            ['id' => 1],
            ['nom' => 'admin']
        );

        Role::updateOrCreate(
            ['id' => 2],
            ['nom' => 'formateur']
        );

        Role::updateOrCreate(
            ['id' => 3],
            ['nom' => 'participant']
        );
    }
}
