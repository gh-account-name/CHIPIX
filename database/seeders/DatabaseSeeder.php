<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'login' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt('123456')
        ]);

        \App\Models\Direction::factory()->create([
            'title' => 'Корпоративное направление',
        ]);

        \App\Models\Direction::factory()->create([
            'title' => 'Направление госзакупок',
        ]);
    }
}
