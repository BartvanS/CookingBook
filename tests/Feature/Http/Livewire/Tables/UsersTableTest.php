<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire\Tables;

use App\Http\Livewire\Tables\UsersTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class UsersTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCanViewTable(): void
    {
        User::factory()->create([
            'name' => 'Henk Steen',
        ]);

        User::factory()->count(5)->create();

        Livewire::test(UsersTable::class)
            ->assertSee('Henk Steen');
    }

    public function testCanSearchUser(): void
    {
        User::factory()->create([
            'name' => 'Henk Steen',
            'email' => 'henk@example.com',
        ]);

        User::factory()->count(5)->create();

        Livewire::test(UsersTable::class)
            ->assertSee('Henk Steen')
            ->assertSee('henk@example.com')
            ->set('search', 'kaas')
            ->assertDontSee('Henk Steen')
            ->assertDontSee('henk@example.com')
            ->set('search', 'example.com')
            ->assertSee('Henk Steen')
            ->assertSee('henk@example.com');
    }
}
