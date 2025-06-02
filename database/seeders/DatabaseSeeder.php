<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Viet My',
            'email' => 'my@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1, // Assuming role_id 1 is for admin
            'phone' => '0123456789',
            // 'address' => '123 Main St, City, Country',
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => null,
            // 'avatar' => 'https://example.com/avatar.jpg', // Replace with a valid URL or path
        ]);
    }
}
