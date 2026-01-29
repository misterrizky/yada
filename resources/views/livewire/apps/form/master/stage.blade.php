<?php

use App\Models\Master\Pipeline;
use App\Models\Master\Stage;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $stageId = null;
    public ?int $pipelineId = null;
    public string $name = '';
    public string $flag = '';
    public string $color = '#3498db';
    public int $order = 0;
    public string $probability = '0';
    public int $is_default = 0;
    public int $is_won = 0;
    public int $is_lost = 0;

    #[On('stage-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('stage-edit')]
    public function startEdit(int $stageId): void
    {
        $stage = Stage::query()->findOrFail($stageId);

        $this->stageId = $stage->id;
        $this->pipelineId = $stage->pipeline_id !== null ? (int) $stage->pipeline_id : null;
        $this->name = (string) $stage->name;
        $this->flag = (string) $stage->flag;
        $this->color = (string) $stage->color;
        $this->order = (int) $stage->order;
        $this->probability = (string) $stage->probability;
        $this->is_default = (int) $stage->is_default;
        $this->is_won = (int) $stage->is_won;
        $this->is_lost = (int) $stage->is_lost;

        $this->dispatch('modal-show', name: 'form-stage');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->stageId !== null;

        $stage = $isUpdate
            ? Stage::query()->findOrFail($this->stageId)
            : new Stage();

        $stage->pipeline_id = $validated['pipelineId'] !== null ? (int) $validated['pipelineId'] : null;
        $stage->name = $validated['name'];
        $stage->flag = $validated['flag'];
        $stage->color = $validated['color'];
        $stage->order = (int) $validated['order'];
        $stage->probability = (string) $validated['probability'];
        $stage->is_default = (int) $validated['is_default'];
        $stage->is_won = (int) $validated['is_won'];
        $stage->is_lost = (int) $validated['is_lost'];
        $stage->save();

        $this->stageId = $stage->id;

        $this->dispatch('stage-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-stage');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Stage updated' : 'Stage created',
            message: $isUpdate
                ? 'The stage has been updated.'
                : 'The stage has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'pipelineId' => ['nullable', 'integer', 'exists:pipelines,id'],
            'name' => ['required', 'string', 'max:255'],
            'flag' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:20'],
            'order' => ['required', 'integer', 'min:0'],
            'probability' => ['required', 'numeric', 'min:0', 'max:100'],
            'is_default' => ['required', 'integer', 'in:0,1'],
            'is_won' => ['required', 'integer', 'in:0,1'],
            'is_lost' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'stageId',
            'pipelineId',
            'name',
            'flag',
            'color',
            'order',
            'probability',
            'is_default',
            'is_won',
            'is_lost',
        ]);

        $this->color = '#3498db';
        $this->order = 0;
        $this->probability = '0';
        $this->is_default = 0;
        $this->is_won = 0;
        $this->is_lost = 0;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-stage"
    :title="$stageId ? 'Edit Stage' : 'New Stage'"
    :subheading="$stageId ? 'Update stage details.' : 'Add a new stage to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:select
        wire:model.live="pipelineId"
        label="Pipeline"
        placeholder="Choose pipeline..."
    >
        <flux:select.option value="">No pipeline</flux:select.option>
        @foreach (Pipeline::query()->orderBy('name')->get(['id', 'name']) as $pipelineOption)
            <flux:select.option value="{{ $pipelineOption->id }}" wire:key="stage-pipeline-{{ $pipelineOption->id }}">
                {{ $pipelineOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:input
                label="Name"
                placeholder="Qualified"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-5">
            <flux:input
                label="Flag"
                placeholder="qualified"
                wire:model.live.debounce.300ms="flag"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Color"
                type="color"
                wire:model.live="color"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Order"
                type="number"
                min="0"
                wire:model.live.debounce.200ms="order"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Probability (%)"
                type="number"
                min="0"
                max="100"
                wire:model.live.debounce.200ms="probability"
            />
        </div>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_default" label="Default Stage">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Default" />
                <flux:radio value="0" label="Not Default" />
            </div>
        </flux:radio.group>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_won" label="Won Stage">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Won" />
                <flux:radio value="0" label="Not Won" />
            </div>
        </flux:radio.group>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_lost" label="Lost Stage">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Lost" />
                <flux:radio value="0" label="Not Lost" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
