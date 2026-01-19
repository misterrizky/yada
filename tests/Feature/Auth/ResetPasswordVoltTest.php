<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ResetPasswordVoltTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_screen_can_be_rendered(): void
    {
        $response = $this->get(route('sso.reset-password', ['token' => 'token']));

        $response->assertStatus(200);
    }

    public function test_password_can_be_reset_using_volt(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $token = Password::broker()->createToken($user);

        Volt::test('sso.reset-password', ['token' => $token])
            ->set('email', $user->email)
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('resetPassword')
            ->assertHasNoErrors()
            ->assertRedirect(route('sso.sign-in', absolute: false));

        $this->assertTrue(auth()->attempt([
            'email' => $user->email,
            'password' => 'new-password',
        ]));
    }

    public function test_password_reset_requires_valid_token(): void
    {
        $user = User::factory()->create();

        Volt::test('sso.reset-password', ['token' => 'invalid-token'])
            ->set('email', $user->email)
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('resetPassword')
            ->assertHasErrors(['email']);
    }
}
