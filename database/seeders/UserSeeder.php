<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::UpdateOrCreate([
            'email' => 'admin@mail.com',
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('admin'),
        ]);
        
        User::UpdateOrCreate([
            'email' => 'stafftu@mail.com',
        ], [
            'name' => 'Staff TU (Tata Usaha)',
            'password' => bcrypt('staff'),
        ]);
        
    }
}
