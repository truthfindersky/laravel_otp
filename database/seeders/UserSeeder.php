<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'mamunandmoana@gmail.com'],
            [
                'name' => 'Abdullah Al Mamun',
                'email' => 'mamunandmoana@gmail.com',
                'password' => Hash::make('12345678'),
                'otp_verified' => true,
            ]
        );
    }
}
