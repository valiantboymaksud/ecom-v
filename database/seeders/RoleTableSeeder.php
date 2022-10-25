<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name'      => 'Admin'
        ]);
        Role::firstOrCreate([
            'name'      => 'Editor'
        ]);
        Role::firstOrCreate([
            'name'      => 'Viewer'
        ]);
    }
}
