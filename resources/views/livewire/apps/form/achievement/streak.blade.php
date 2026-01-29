<?php

use App\Models\User;
use LevelUp\Experience\Models\Activity;
use LevelUp\Experience\Models\Streak;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $streakId = null;
    public ?int $userId = null;
    public ?int $activityId = null;
    public int $count = 1;
    public string $activity_at = '';
    public string $frozen_until = '';

    #[On('streak-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('streak-edit')]
    public function startEdit(int $streakId): void
    {
        $streak = Streak::query()->findOrFail($streakId);

        $this->streakId = $streak->id;
        $this->userId = (int) $streak->user_id;
        $this->activityId = (int) $streak->activity_id;
        $this->count = (int) $streak->count;
        $this->activity_at = $streak->activity_at?->format('Y-m-d\TH:i') ?? '';
        $this->frozen_until = $streak->frozen_until?->format('Y-m-d\TH:i') ?? '';

        $this->dispatch('modal-show', name: 'form-streak');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->streakId !== null;

        $streak = $isUpdate
            ? Streak::query()->findOrFail($this->streakId)
            : new Streak();

        $streak->user_id = $validated['userId'];
        $streak->activity_id = $validated['activityId'];
        $streak->count = (int) $validated['count'];
        $streak->activity_at = $validated['activity_at'];
        $streak->frozen_until = $validated['frozen_until'] !== '' ? $validated['frozen_until'] : null;
        $streak->save();

        $this->streakId = $streak->id;

        $this->dispatch('streak-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-streak');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Streak updated' : 'Streak created',
            message: $isUpdate
                ? 'The streak has been updated.'
                : 'The streak has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'userId' => ['required', 'integer', 'exists:users,id'],
            'activityId' => ['required', 'integer', 'exists:streak_activities,id'],
            'count' => ['required', 'integer', 'min:1'],
            'activity_at' => ['required', 'date'],
            'frozen_until' => ['nullable', 'date'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'streakId',
            'userId',
            'activityId',
            'count',
            'activity_at',
            'frozen_until',
        ]);

        $this->count = 1;
        $this->activity_at = now()->format('Y-m-d\TH:i');
        $this->frozen_until = '';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-streak"
    :title="$streakId ? 'Edit Streak' : 'New Streak'"
    :subheading="$streakId ? 'Update streak details.' : 'Add a new streak record.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="userId"
                label="User"
                placeholder="Choose user..."
                searchable
            >
                @foreach (User::query()->orderBy('name')->get(['id', 'name', 'email']) as $userOption)
                    <flux:select.option value="{{ $userOption->id }}" wire:key="streak-user-{{ $userOption->id }}">
                        {{ $userOption->name }} ({{ $userOption->email }})
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="activityId"
                label="Activity"
                placeholder="Choose activity..."
            >
                @foreach (Activity::query()->orderBy('name')->get(['id', 'name']) as $activityOption)
                    <flux:select.option value="{{ $activityOption->id }}" wire:key="streak-activity-{{ $activityOption->id }}">
                        {{ $activityOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Count"
                type="number"
                min="1"
                wire:model.live.debounce.200ms="count"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Activity At"
                type="datetime-local"
                wire:model.live.debounce.200ms="activity_at"
            />
        </div>
    </div>

    <flux:input
        label="Frozen Until"
        type="datetime-local"
        wire:model.live.debounce.200ms="frozen_until"
    />
</x-app.modal.form>
