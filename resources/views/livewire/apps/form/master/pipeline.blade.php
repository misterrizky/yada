<?php

use App\Models\Master\Pipeline;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $pipelineId = null;
    public string $name = '';
    public string $flag = '';

    #[On('pipeline-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('pipeline-edit')]
    public function startEdit(int $pipelineId): void
    {
        $pipeline = Pipeline::query()->findOrFail($pipelineId);

        $this->pipelineId = $pipeline->id;
        $this->name = (string) $pipeline->name;
        $this->flag = (string) $pipeline->flag;

        $this->dispatch('modal-show', name: 'form-pipeline');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->pipelineId !== null;

        $pipeline = $isUpdate
            ? Pipeline::query()->findOrFail($this->pipelineId)
            : new Pipeline();

        $pipeline->name = $validated['name'];
        $pipeline->flag = $validated['flag'];
        $pipeline->save();

        $this->pipelineId = $pipeline->id;

        $this->dispatch('pipeline-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-pipeline');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Pipeline updated' : 'Pipeline created',
            message: $isUpdate
                ? 'The pipeline has been updated.'
                : 'The pipeline has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'flag' => ['required', 'string', 'max:255'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'pipelineId',
            'name',
            'flag',
        ]);

        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-pipeline"
    :title="$pipelineId ? 'Edit Pipeline' : 'New Pipeline'"
    :subheading="$pipelineId ? 'Update pipeline details.' : 'Add a new pipeline to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:input
                label="Name"
                placeholder="Sales"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-5">
            <flux:input
                label="Flag"
                placeholder="sales"
                wire:model.live.debounce.300ms="flag"
                autocomplete="off"
            />
        </div>
    </div>
</x-app.modal.form>
