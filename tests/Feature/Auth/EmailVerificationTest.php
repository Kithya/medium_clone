<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;

test('email verification screen is disabled', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertNotFound();
});

test('new users are not sent email verification notifications', function () {
    Notification::fake();

    $this->post('/register', [
        'username' => 'test-user',
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    Notification::assertNothingSent();
});
