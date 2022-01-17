<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class TagSeeder extends Seeder
{
    public function run(): void
    {
        $list = [
            'Gezond',
            'Vegan',
            'Glutenvrij',
            'Toetje',
            'Chocolade',
            'Ongezond',
            'Lekker vet',
            'Caloriebom',
        ];

        foreach ($list as $name) {
            Tag::factory()->create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
