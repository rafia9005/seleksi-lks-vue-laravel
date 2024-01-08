<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => "rafia9005",
            'password' => bcrypt('ahmadrafi01'),
        ]);
        User::create([
            'username' => "asepkurniawan",
            'password' => bcrypt('ahmadrafi01'),
        ]);
    }
}
