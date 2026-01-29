<?php

use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

new class extends Component {
    public ?int $permissionId = null;
    public string $name = '';
    public string $guard_name = '';
    public array $guardOptions = [];

    public function mount(): void
    {
        $this->guardOptions = $this->resolveGuardOptions();
        $this->guard_name = $this->defaultGuard();
    }

    #[On('permission-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('permission-edit')]
    public function startEdit(int $permissionId): void
    {
        $permission = Permission::query()->findOrFail($permissionId);

        $this->permissionId = $permission->id;
        $this->name = (string) $permission->name;
        $this->guard_name = (string) $permission->guard_name;

        $this->dispatch('modal-show', name: 'form-permission');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->permissionId !== null;

        $permission = $isUpdate
            ? Permission::query()->findOrFail($this->permissionId)
            : new Permission();

        $permission->name = $validated['name'];
        $permission->guard_name = $validated['guard_name'];
        $permission->save();

        $this->permissionId = $permission->id;

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->dispatch('permission-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-permission');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Permission updated' : 'Permission created',
            message: $isUpdate
                ? 'The permission has been updated.'
                : 'The permission has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')
                    ->where(fn ($query) => $query->where('guard_name', $this->guard_name))
                    ->ignore($this->permissionId),
            ],
            'guard_name' => ['required', 'string', 'max:50', Rule::in($this->guardOptions)],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'permissionId',
            'name',
            'guard_name',
        ]);

        $this->guard_name = $this->defaultGuard();
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
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
    name="form-permission"
    :title="$permissionId ? 'Edit Permission' : 'New Permission'"
    :subheading="$permissionId ? 'Update permission details.' : 'Add a new permission to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:input
                label="Name"
                placeholder="view dashboard"
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
</x-app.modal.form>
