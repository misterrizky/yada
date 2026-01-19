<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ForgotPasswordVoltTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_screen_can_be_rendered(): void
    {
        $response = $this->get(route('sso.forgot-password'));

        $response->assertStatus(200);
    }

    public function test_password_reset_link_can_be_requested_using_volt(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $test = Volt::test('sso.forgot-password')
            ->set('email', $user->email)
            ->call('sendPasswordResetLink');

        $test->assertHasNoErrors();

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_password_reset_link_requires_valid_email(): void
    {
        Volt::test('sso.forgot-password')
            ->set('email', 'not-an-email')
            ->call('sendPasswordResetLink')
            ->assertHasErrors(['email']);
    }
}
