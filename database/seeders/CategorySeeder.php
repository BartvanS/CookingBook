<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

final class CategorySeeder extends Seeder
{
    public function run()
    {
        $list = ['Voorafje', 'Voorgerecht', 'Hoofdgerecht', 'Dessert'];

        foreach ($list as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}
