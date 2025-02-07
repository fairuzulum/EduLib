<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
        ]);

        User::create([
            'name' => 'librarian',
            'email' => 'librarian@gmail.com',
            'role' => 'librarian',
            'password' => Hash::make('password')
        ]);
    }
}
