<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class TwoFactorChallengeVoltTest extends TestCase
{
    use RefreshDatabase;

    public function test_two_factor_challenge_screen_can_be_rendered(): void
    {
        $user = User::factory()->withTwoFactor()->create();

        $response = $this->withSession([
            'login.id' => $user->id,
        ])->get(route('sso.two-fa'));

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_recovery_code(): void
    {
        $user = User::factory()->withTwoFactor()->create();

        $this->withSession([
            'login.id' => $user->id,
        ]);

        Volt::test('sso.two-factor-challenge')
            ->set('showRecoveryInput', true)
            ->set('recovery_code', 'recovery-code-1')
            ->call('login')
            ->assertHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticatedAs($user);
    }

    public function test_users_cannot_authenticate_with_invalid_recovery_code(): void
    {
        $user = User::factory()->withTwoFactor()->create();

        $this->withSession([
            'login.id' => $user->id,
        ]);

        Volt::test('sso.two-factor-challenge')
            ->set('showRecoveryInput', true)
            ->set('recovery_code', 'invalid-code')
            ->call('login')
            ->assertHasErrors(['recovery_code']);

        $this->assertGuest();
    }
}
