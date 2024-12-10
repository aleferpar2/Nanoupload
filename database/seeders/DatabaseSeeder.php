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

        User::factory()->create(['name' => 'Test User A', 'email' => 'a@a.a', 'password' => 'a']);
        User::factory()->create(['name' => 'Test User B', 'email' => 'b@b.b', 'password' => 'b']);
        User::factory()->create(['name' => 'Test User C', 'email' => 'c@c.c', 'password' => 'c']);

    }
}
