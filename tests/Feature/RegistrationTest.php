<?php

declare(strict_types=1);

use App\Providers\RouteServiceProvider;

it('can render registration', function (): void {
    $response = $this->get('/register');

    $response->assertOk();
});

it('can register', function (): void {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
