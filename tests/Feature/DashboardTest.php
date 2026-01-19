<?php

namespace Tests\Feature;

use App\Models\User;
use App\Settings\AppearanceSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('app.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('app.dashboard'));
        $response->assertStatus(200);
    }

    public function test_mobile_bottom_nav_is_rendered_for_flux_layout(): void
    {
        $user = User::factory()->create();
        $settings = app(AppearanceSettings::class);
        $settings->theme_app = 'flux';
        $settings->layout_app = 'sidebar';
        $settings->save();

        $response = $this->actingAs($user)->get(route('app.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('data-test="mobile-bottom-nav"', false);
    }
}
