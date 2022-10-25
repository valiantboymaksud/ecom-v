<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'phone'     => '123456789',
            'password'  => Hash::make(12345),
            'role_id'   => 1,
        ]);
        User::firstOrCreate([
            'name'      => 'Editor',
            'username'  => 'editor',
            'email'     => 'editor@gmail.com',
            'phone'     => '1234567890',
            'password'  => Hash::make(12345),
            'role_id'   => 2,
        ]);
        User::firstOrCreate([
            'name'      => 'Viewer',
            'username'  => 'viewer',
            'email'     => 'viewer@gmail.com',
            'phone'     => '1234567891',
            'password'  => Hash::make(12345),
            'role_id'   => 3,
        ]);
    }
}
