<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RbacManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles_index_shows_roles(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');
        $permission = Permission::create([
            'name' => 'view dashboard',
            'guard_name' => $defaultGuard,
        ]);
        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => $defaultGuard,
        ]);
        $role->givePermissionTo($permission);

        $response = $this->actingAs($user)
            ->get(route('app.role'));

        $response->assertOk();
        $response->assertSee('Admin');
        $response->assertSee($defaultGuard);
    }

    public function test_roles_index_deletes_role(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');
        $role = Role::create([
            'name' => 'Editor',
            'guard_name' => $defaultGuard,
        ]);

        Volt::actingAs($user)
            ->test('apps.rbac.roles.index')
            ->call('deleteRole', $role->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    public function test_permissions_index_shows_permissions(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');
        Permission::create([
            'name' => 'edit users',
            'guard_name' => $defaultGuard,
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.permission'));

        $response->assertOk();
        $response->assertSee('edit users');
    }

    public function test_permissions_index_deletes_permission(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');
        $permission = Permission::create([
            'name' => 'delete users',
            'guard_name' => $defaultGuard,
        ]);

        Volt::actingAs($user)
            ->test('apps.rbac.permissions.index')
            ->call('deletePermission', $permission->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('permissions', [
            'id' => $permission->id,
        ]);
    }

    public function test_role_form_creates_role_with_permissions(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');
        $permission = Permission::create([
            'name' => 'manage posts',
            'guard_name' => $defaultGuard,
        ]);

        Volt::actingAs($user)
            ->test('apps.form.rbac.role')
            ->set('name', 'Manager')
            ->set('guard_name', $defaultGuard)
            ->set('permissionIds', [$permission->id])
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-role');

        $role = Role::query()->where('name', 'Manager')->first();

        $this->assertNotNull($role);
        $this->assertTrue($role->hasPermissionTo($permission));
    }

    public function test_role_form_requires_fields(): void
    {
        Volt::test('apps.form.rbac.role')
            ->set('guard_name', 'invalid')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'guard_name' => 'in',
            ]);
    }

    public function test_permission_form_creates_permission(): void
    {
        $user = User::factory()->create();
        $defaultGuard = (string) config('auth.defaults.guard', 'web');

        Volt::actingAs($user)
            ->test('apps.form.rbac.permission')
            ->set('name', 'view reports')
            ->set('guard_name', $defaultGuard)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-permission');

        $this->assertDatabaseHas('permissions', [
            'name' => 'view reports',
            'guard_name' => $defaultGuard,
        ]);
    }

    public function test_permission_form_requires_fields(): void
    {
        Volt::test('apps.form.rbac.permission')
            ->set('guard_name', 'invalid')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'guard_name' => 'in',
            ]);
    }
}
