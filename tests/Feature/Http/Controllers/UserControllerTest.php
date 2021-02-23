<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCannotViewUsersIndex()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('users.index'));

        $response->assertForbidden();
    }

    public function testAdminCanViewUsersIndex()
    {
        $this->actingAs(User::factory()->admin()->create());

        User::factory()->count(10)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk();
    }

    public function testAdminCanViewCreate()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get(route('users.create'));

        $response->assertOk();
    }

    public function testCanStoreUser()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->post(route('users.store'), [
            'name' => 'Henk Steen',
            'email' => 'henk@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'Henk Steen',
            'email' => 'henk@example.com',
        ]);
    }

    public function testCanViewEdit()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get(route('users.edit', User::factory()->create()));

        $response->assertOk();
    }

    public function testCanUpdateUser()
    {
        $this->actingAs(User::factory()->admin()->create());

        $user = User::factory()->create();

        $response = $this->put(route('users.update', $user), [
            'name' => 'Henk Steen',
            'email' => 'henk@example.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'Henk Steen',
            'email' => 'henk@example.com',
        ]);
    }

    public function testCanDeleteUser()
    {
        $this->actingAs(User::factory()->admin()->create());

        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));

        $this->assertSoftDeleted($user);
    }

    public function testCannotDeleteSelf()
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user);

        $response = $this->delete(route('users.destroy', $user));

        $response->assertForbidden();
    }
}
