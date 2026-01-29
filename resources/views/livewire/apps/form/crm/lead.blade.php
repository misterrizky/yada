<?php

use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use App\Models\CRM\Source;
use App\Models\Master\Industry;
use App\Models\Master\Stage;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $leadId = null;
    public string $code = '';
    public string $name = '';
    public string $company_name = '';
    public string $email = '';
    public string $phone = '';
    public string $website = '';
    public string $address = '';
    public string $value = '0';
    public string $notes = '';
    public ?int $sourceId = null;
    public ?int $stageId = null;
    public ?int $industryId = null;
    public ?int $userId = null;
    public ?int $companyId = null;
    public string $converted_at = '';

    #[On('lead-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('lead-edit')]
    public function startEdit(int $leadId): void
    {
        $lead = Lead::query()->findOrFail($leadId);

        $this->leadId = $lead->id;
        $this->code = (string) ($lead->code ?? '');
        $this->name = (string) $lead->name;
        $this->company_name = (string) ($lead->company_name ?? '');
        $this->email = (string) ($lead->email ?? '');
        $this->phone = (string) ($lead->phone ?? '');
        $this->website = (string) ($lead->website ?? '');
        $this->address = (string) ($lead->address ?? '');
        $this->value = (string) $lead->value;
        $this->notes = (string) ($lead->notes ?? '');
        $this->sourceId = $lead->source_id !== null ? (int) $lead->source_id : null;
        $this->stageId = $lead->stage_id !== null ? (int) $lead->stage_id : null;
        $this->industryId = $lead->industry_id !== null ? (int) $lead->industry_id : null;
        $this->userId = $lead->user_id !== null ? (int) $lead->user_id : null;
        $this->companyId = $lead->company_id !== null ? (int) $lead->company_id : null;
        $this->converted_at = $lead->converted_at ? Carbon::parse($lead->converted_at)->format('Y-m-d\TH:i') : '';

        $this->dispatch('modal-show', name: 'form-lead');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->leadId !== null;

        $lead = $isUpdate
            ? Lead::query()->findOrFail($this->leadId)
            : new Lead();

        if (! $isUpdate) {
            $lead->ulid = (string) Str::ulid();
        }

        $lead->code = $validated['code'] !== '' ? $validated['code'] : null;
        $lead->name = $validated['name'];
        $lead->company_name = $validated['company_name'] !== '' ? $validated['company_name'] : null;
        $lead->email = $validated['email'] !== '' ? $validated['email'] : null;
        $lead->phone = $validated['phone'] !== '' ? $validated['phone'] : null;
        $lead->website = $validated['website'] !== '' ? $validated['website'] : null;
        $lead->address = $validated['address'] !== '' ? $validated['address'] : null;
        $lead->value = (string) $validated['value'];
        $lead->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $lead->source_id = $validated['sourceId'] !== null ? (int) $validated['sourceId'] : null;
        $lead->stage_id = $validated['stageId'] !== null ? (int) $validated['stageId'] : null;
        $lead->industry_id = $validated['industryId'] !== null ? (int) $validated['industryId'] : null;
        $lead->user_id = $validated['userId'] !== null ? (int) $validated['userId'] : null;
        $lead->company_id = $validated['companyId'] !== null ? (int) $validated['companyId'] : null;
        $lead->converted_at = $validated['converted_at'] !== ''
            ? Carbon::parse($validated['converted_at'])->format('Y-m-d H:i:s')
            : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $lead->created_by = $userId;
        }
        $lead->updated_by = $userId;

        $lead->save();

        $this->leadId = $lead->id;

        $this->dispatch('lead-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-lead');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Lead updated' : 'Lead created',
            message: $isUpdate
                ? 'The lead has been updated.'
                : 'The lead has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:255', Rule::unique('leads', 'code')->ignore($this->leadId)],
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'value' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'sourceId' => ['nullable', 'integer', 'exists:sources,id'],
            'stageId' => ['nullable', 'integer', 'exists:stages,id'],
            'industryId' => ['nullable', 'integer', 'exists:industries,id'],
            'userId' => ['nullable', 'integer', 'exists:users,id'],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
            'converted_at' => ['nullable', 'date'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'leadId',
            'code',
            'name',
            'company_name',
            'email',
            'phone',
            'website',
            'address',
            'value',
            'notes',
            'sourceId',
            'stageId',
            'industryId',
            'userId',
            'companyId',
            'converted_at',
        ]);

        $this->value = '0';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-lead"
    :title="$leadId ? 'Edit Lead' : 'New Lead'"
    :subheading="$leadId ? 'Update lead details.' : 'Add a new lead to the pipeline.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="LEAD-001"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Lead name"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:input
        label="Company Name"
        placeholder="Company name"
        wire:model.live.debounce.300ms="company_name"
        autocomplete="off"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Email"
                type="email"
                placeholder="email@example.com"
                wire:model.live.debounce.300ms="email"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Phone"
                placeholder="Phone number"
                wire:model.live.debounce.300ms="phone"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Website"
                placeholder="https://"
                wire:model.live.debounce.300ms="website"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:textarea
        label="Address"
        placeholder="Address..."
        wire:model.live.debounce.300ms="address"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Value"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="value"
            />
        </div>
        <div class="md:col-span-8">
            <flux:select
                wire:model.live="sourceId"
                label="Source"
                placeholder="Choose source..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No source</flux:select.option>
                @foreach (Source::query()->orderBy('name')->get(['id', 'name']) as $sourceOption)
                    <flux:select.option value="{{ $sourceOption->id }}" wire:key="lead-source-{{ $sourceOption->id }}">
                        {{ $sourceOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="stageId"
                label="Stage"
                placeholder="Choose stage..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No stage</flux:select.option>
                @foreach (Stage::query()->orderBy('order')->get(['id', 'name']) as $stageOption)
                    <flux:select.option value="{{ $stageOption->id }}" wire:key="lead-stage-{{ $stageOption->id }}">
                        {{ $stageOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="industryId"
                label="Industry"
                placeholder="Choose industry..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No industry</flux:select.option>
                @foreach (Industry::query()->orderBy('name')->get(['id', 'name']) as $industryOption)
                    <flux:select.option value="{{ $industryOption->id }}" wire:key="lead-industry-{{ $industryOption->id }}">
                        {{ $industryOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="userId"
                label="Owner"
                placeholder="Choose owner..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">Unassigned</flux:select.option>
                @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
                    <flux:select.option value="{{ $userOption->id }}" wire:key="lead-owner-{{ $userOption->id }}">
                        {{ $userOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <flux:select
        wire:model.live="companyId"
        label="Company (Converted)"
        placeholder="Choose company..."
        searchable
        variant="listbox"
    >
        <flux:select.option value="">Not converted</flux:select.option>
        @foreach (Company::query()->orderBy('name')->get(['id', 'name']) as $companyOption)
            <flux:select.option value="{{ $companyOption->id }}" wire:key="lead-company-{{ $companyOption->id }}">
                {{ $companyOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:input
        label="Converted At"
        type="datetime-local"
        wire:model.live="converted_at"
    />

    <flux:textarea
        label="Notes"
        placeholder="Notes..."
        wire:model.live.debounce.300ms="notes"
    />
</x-app.modal.form>
