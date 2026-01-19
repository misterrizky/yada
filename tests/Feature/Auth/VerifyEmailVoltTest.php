<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Volt;
use Tests\TestCase;

class VerifyEmailVoltTest extends TestCase
{
    use RefreshDatabase;

    public function test_verify_email_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get(route('sso.verify-email'));

        $response->assertStatus(200);
    }

    public function test_verification_link_can_be_resent(): void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        Volt::test('sso.verify-email')
            ->call('resend')
            ->assertHasNoErrors();

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_users_can_logout_from_verify_email_screen(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Volt::test('sso.verify-email')
            ->call('logout')
            ->assertRedirect(route('sso.sign-in', absolute: false));

        $this->assertGuest();
    }
}
