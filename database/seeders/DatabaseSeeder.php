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
            'fio' => 'Admin User',
            'email' => 'admin@prof.ru',
            'password'=> 1111,
            'is_admin' => true
        ]);

        User::factory(5)->create();
    }
}
