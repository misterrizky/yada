<?php

namespace Tests\Feature;

use App\Models\User;
use App\Settings\AppearanceSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class InternalSidebarTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('roleProvider')]
    public function test_internal_sidebar_includes_module_navigation(string $roleName): void
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
        $response->assertSee('Model Has Roles', false);
        $response->assertSee('Mediables', false);
        $response->assertSee('Activity Relations', false);
        $response->assertSee('Ticket Tag Relations', false);
        $response->assertSee('Achievement Users', false);
        $response->assertSee('Post Category Relations', false);
    }

    public function test_internal_sidebar_group_icons_match_headings(): void
    {
        $contents = file_get_contents(base_path('resources/views/components/layouts/app/flux/partials/sidebar/internal.blade.php'));

        $this->assertIsString($contents);

        $expectedIcons = [
            'CRM' => 'building-office-2',
            'Sales' => 'shopping-cart',
            'Project' => 'clipboard-document-list',
            'Finance' => 'banknotes',
            'Support' => 'lifebuoy',
            'DMS' => 'folder',
            'CMS' => 'newspaper',
            'HR' => 'briefcase',
            'Resource' => 'square-3-stack-3d',
            'Procurement' => 'truck',
            'Asset' => 'cube',
            'QA' => 'check-badge',
            'Approval' => 'check-circle',
            'Users' => 'users',
            'Master Data' => 'circle-stack',
            'Regional' => 'globe-alt',
            'Achievements' => 'trophy',
            'RBAC' => 'key',
            'System' => 'cpu-chip',
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
            ['Super Admin'],
            ['Direktur Utama'],
            ['Direktur'],
            ['Sekretaris Perusahaan'],
            ['Head'],
            ['Manager'],
            ['Staff'],
        ];
    }
}
