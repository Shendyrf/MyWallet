<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class auth extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Shendy',
            'email' => 'shendy@gmail.com',
            'password' => bcrypt('sheland123'),
        ]);
    }
}
