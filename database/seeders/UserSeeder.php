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
            'name' => 'John',
            'username' => 'john@mail.com',
            'password' => Hash::make('john@123')
        ]);

        User::create([
            'name' => 'Doe',
            'username' => 'doe@mail.com',
            'password' => Hash::make('doe@123')
        ]);
    }
}
