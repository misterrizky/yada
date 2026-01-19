<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class SignInVoltTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_volt(): void
    {
        $user = User::factory()->create();

        Volt::test('sso.login')
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('signin')
            ->assertHasNoErrors()
            ->assertRedirect(config('fortify.home', '/dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_users_can_not_authenticate_with_invalid_password_using_volt(): void
    {
        $user = User::factory()->create();

        Volt::test('sso.login')
            ->set('email', $user->email)
            ->set('password', 'wrong-password')
            ->call('signin')
            ->assertHasErrors(['email']);

        $this->assertGuest();
    }
}
