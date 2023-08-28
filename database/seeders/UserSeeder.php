<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $admin->assignRole('admin');
        $penulis = User::create([
            'name' => 'penulis',
            'email' => 'penulis@gmail.com',
            'password' => bcrypt('penulis123')
        ]);

       $penulis->assignRole('penulis');
    }
}
