<?php

use App\Models\User;
use LevelUp\Experience\Models\Experience;
use LevelUp\Experience\Models\Level;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $experienceId = null;
    public ?int $userId = null;
    public ?int $levelId = null;
    public int $experience_points = 0;

    #[On('experience-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('experience-edit')]
    public function startEdit(int $experienceId): void
    {
        $experience = Experience::query()->findOrFail($experienceId);

        $this->experienceId = $experience->id;
        $this->userId = (int) $experience->user_id;
        $this->levelId = (int) $experience->level_id;
        $this->experience_points = (int) $experience->experience_points;

        $this->dispatch('modal-show', name: 'form-experience');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->experienceId !== null;

        $experience = $isUpdate
            ? Experience::query()->findOrFail($this->experienceId)
            : new Experience();

        $experience->user_id = $validated['userId'];
        $experience->level_id = $validated['levelId'];
        $experience->experience_points = (int) $validated['experience_points'];
        $experience->save();

        $this->experienceId = $experience->id;

        $this->dispatch('experience-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-experience');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Experience updated' : 'Experience created',
            message: $isUpdate
                ? 'The experience has been updated.'
                : 'The experience has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'userId' => ['required', 'integer', 'exists:users,id'],
            'levelId' => ['required', 'integer', 'exists:levels,id'],
            'experience_points' => ['required', 'integer', 'min:0'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'experienceId',
            'userId',
            'levelId',
            'experience_points',
        ]);

        $this->experience_points = 0;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-experience"
    :title="$experienceId ? 'Edit Experience' : 'New Experience'"
    :subheading="$experienceId ? 'Update experience details.' : 'Add a new experience record.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:select
                wire:model.live="userId"
                label="User"
                placeholder="Choose user..."
                searchable
            >
                @foreach (User::query()->orderBy('name')->get(['id', 'name', 'email']) as $userOption)
                    <flux:select.option value="{{ $userOption->id }}" wire:key="experience-user-{{ $userOption->id }}">
                        {{ $userOption->name }} ({{ $userOption->email }})
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <div class="md:col-span-5">
            <flux:select
                wire:model.live="levelId"
                label="Level"
                placeholder="Choose level..."
            >
                @foreach (Level::query()->orderBy('level')->get(['id', 'level']) as $levelOption)
                    <flux:select.option value="{{ $levelOption->id }}" wire:key="experience-level-{{ $levelOption->id }}">
                        Level {{ $levelOption->level }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <flux:input
        label="Experience Points"
        type="number"
        min="0"
        wire:model.live.debounce.300ms="experience_points"
    />
</x-app.modal.form>
