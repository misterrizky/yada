<?php

use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

new class extends Component {
    public ?int $roleId = null;
    public string $name = '';
    public string $guard_name = '';
    public array $permissionIds = [];
    public array $guardOptions = [];
    public array $permissionOptions = [];

    public function mount(): void
    {
        $this->guardOptions = $this->resolveGuardOptions();
        $this->guard_name = $this->defaultGuard();
        $this->loadPermissions();
    }

    public function updatedGuardName(string $value): void
    {
        $this->guard_name = $value;
        $this->permissionIds = [];

        $this->loadPermissions();
    }

    #[On('role-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('role-edit')]
    public function startEdit(int $roleId): void
    {
        $role = Role::query()->with('permissions')->findOrFail($roleId);

        $this->roleId = $role->id;
        $this->name = (string) $role->name;
        $this->guard_name = (string) $role->guard_name;
        $this->permissionIds = $role->permissions->pluck('id')->all();

        $this->loadPermissions();

        $this->dispatch('modal-show', name: 'form-role');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->roleId !== null;

        $role = $isUpdate
            ? Role::query()->findOrFail($this->roleId)
            : new Role();

        $role->name = $validated['name'];
        $role->guard_name = $validated['guard_name'];
        $role->save();

        $permissions = Permission::query()
            ->whereIn('id', $validated['permissionIds'] ?? [])
            ->get();

        $role->syncPermissions($permissions);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->roleId = $role->id;

        $this->dispatch('role-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-role');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Role updated' : 'Role created',
            message: $isUpdate
                ? 'The role has been updated.'
                : 'The role has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')
                    ->where(fn ($query) => $query->where('guard_name', $this->guard_name))
                    ->ignore($this->roleId),
            ],
            'guard_name' => ['required', 'string', 'max:50', Rule::in($this->guardOptions)],
            'permissionIds' => ['array'],
            'permissionIds.*' => [
                'integer',
                Rule::exists('permissions', 'id')
                    ->where(fn ($query) => $query->where('guard_name', $this->guard_name)),
            ],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'roleId',
            'name',
            'guard_name',
            'permissionIds',
        ]);

        $this->guard_name = $this->defaultGuard();
        $this->loadPermissions();
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }

    private function loadPermissions(): void
    {
        $this->permissionOptions = Permission::query()
            ->where('guard_name', $this->guard_name)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn ($permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
            ])
            ->all();
    }

    private function resolveGuardOptions(): array
    {
        $guards = array_keys((array) config('auth.guards', []));

        if ($guards === []) {
            return ['web'];
        }

        return $guards;
    }

    private function defaultGuard(): string
    {
        $default = (string) config('auth.defaults.guard', '');

        if ($default !== '' && in_array($default, $this->guardOptions, true)) {
            return $default;
        }

        return $this->guardOptions[0] ?? 'web';
    }
};

?>

<x-app.modal.form
    name="form-role"
    :title="$roleId ? 'Edit Role' : 'New Role'"
    :subheading="$roleId ? 'Update role details and permissions.' : 'Add a new role and assign permissions.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:input
                label="Name"
                placeholder="Admin"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>

        <div class="md:col-span-5">
            <flux:select
                wire:model.live="guard_name"
                label="Guard"
                placeholder="Select guard..."
            >
                @foreach ($guardOptions as $guardOption)
                    <flux:select.option value="{{ $guardOption }}">
                        {{ strtoupper($guardOption) }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-white/10 dark:bg-white/5">
        <flux:checkbox.group
            wire:model.live="permissionIds"
            label="Permissions"
            variant="cards"
            class="flex-col"
        >
            @forelse ($permissionOptions as $permission)
                <flux:checkbox
                    value="{{ $permission['id'] }}"
                    label="{{ $permission['name'] }}"
                    wire:key="role-permission-{{ $permission['id'] }}"
                />
            @empty
                <div class="rounded-lg border border-dashed border-gray-200 bg-white px-3 py-2 text-sm text-gray-500 dark:border-white/10 dark:bg-white/10 dark:text-gray-400">
                    No permissions available for this guard.
                </div>
            @endforelse
        </flux:checkbox.group>
    </div>
</x-app.modal.form>
