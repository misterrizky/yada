<?php

namespace Tests\Feature;

use App\Models\User;
use App\Settings\AppearanceSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ClientPartnerSidebarTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('roleProvider')]
    public function test_client_partner_sidebar_includes_module_navigation(string $roleName): void
    {
        Role::firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'web',
        ]);

        $user = User::factory()->create([
            'username' => fake()->unique()->userName(),
        ]);
        $user->assignRole($roleName);

        $settings = app(AppearanceSettings::class);
        $settings->theme_app = 'flux';
        $settings->layout_app = 'sidebar';
        $settings->save();

        $response = $this->actingAs($user)->get(route('app.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('CRM', false);
        $response->assertSee('Contracts', false);
        $response->assertSee('Projects', false);
        $response->assertSee('Invoices', false);
        $response->assertSee('Tickets', false);
        $response->assertSee('Documents', false);
        $response->assertSee('Knowledge Base Articles', false);
        $response->assertDontSee('Master Data', false);
        $response->assertDontSee('System', false);
    }

    public function test_client_partner_sidebar_group_icons_match_headings(): void
    {
        $contents = file_get_contents(base_path('resources/views/components/layouts/app/flux/partials/sidebar/client.blade.php'));

        $this->assertIsString($contents);

        $expectedIcons = [
            'CRM' => 'building-office-2',
            'Sales' => 'shopping-cart',
            'Project' => 'clipboard-document-list',
            'Finance' => 'banknotes',
            'Support' => 'lifebuoy',
            'DMS' => 'folder',
        ];

        foreach ($expectedIcons as $heading => $icon) {
            $this->assertStringContainsString(sprintf('icon="%s" heading="%s"', $icon, $heading), $contents);
        }
    }

    /**
     * @return array<int, array{0: string}>
     */
    public static function roleProvider(): array
    {
        return [
            ['Client'],
            ['Partner'],
        ];
    }
}
