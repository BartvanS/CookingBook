<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Livewire\Livewire;
use Tests\TestCase;

final class BrowserSessionsTest extends TestCase
{
    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(LogoutOtherBrowserSessionsForm::class)
                ->set('password', 'password')
                ->call('logoutOtherBrowserSessions');
    }
}
