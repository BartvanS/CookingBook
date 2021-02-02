<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'a@a',
            'password' => Hash::make('a'),
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        Recipe::factory(50)->create();
    }
}
