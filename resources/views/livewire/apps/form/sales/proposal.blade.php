<?php

use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use App\Models\Regional\Currency;
use App\Models\Sales\Proposal;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $proposalId = null;
    public string $proposal_number = '';
    public ?int $leadId = null;
    public ?int $companyId = null;
    public string $title = '';
    public string $description = '';
    public string $valid_until = '';
    public string $status = 'draft';
    public ?int $currencyId = null;
    public string $sub_total = '0';
    public string $discount = '0';
    public string $discount_type = 'fixed';
    public string $tax = '0';
    public string $total = '0';
    public string $terms_conditions = '';
    public string $notes = '';
    public ?int $approvedById = null;

    #[On('proposal-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('proposal-edit')]
    public function startEdit(int $proposalId): void
    {
        $proposal = Proposal::query()->findOrFail($proposalId);

        $this->proposalId = $proposal->id;
        $this->proposal_number = (string) $proposal->proposal_number;
        $this->leadId = $proposal->lead_id !== null ? (int) $proposal->lead_id : null;
        $this->companyId = $proposal->company_id !== null ? (int) $proposal->company_id : null;
        $this->title = (string) $proposal->title;
        $this->description = (string) ($proposal->description ?? '');
        $this->valid_until = $proposal->valid_until ? (string) $proposal->valid_until : '';
        $this->status = (string) $proposal->status;
        $this->currencyId = $proposal->currency_id !== null ? (int) $proposal->currency_id : null;
        $this->sub_total = (string) $proposal->sub_total;
        $this->discount = (string) $proposal->discount;
        $this->discount_type = (string) $proposal->discount_type;
        $this->tax = (string) $proposal->tax;
        $this->total = (string) $proposal->total;
        $this->terms_conditions = (string) ($proposal->terms_conditions ?? '');
        $this->notes = (string) ($proposal->notes ?? '');
        $this->approvedById = $proposal->approved_by !== null ? (int) $proposal->approved_by : null;

        $this->dispatch('modal-show', name: 'form-proposal');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->proposalId !== null;

        $proposal = $isUpdate
            ? Proposal::query()->findOrFail($this->proposalId)
            : new Proposal();

        if (! $isUpdate) {
            $proposal->ulid = (string) Str::ulid();
        }

        $proposal->proposal_number = $validated['proposal_number'];
        $proposal->lead_id = $validated['leadId'] !== null ? (int) $validated['leadId'] : null;
        $proposal->company_id = $validated['companyId'] !== null ? (int) $validated['companyId'] : null;
        $proposal->title = $validated['title'];
        $proposal->description = $validated['description'] !== '' ? $validated['description'] : null;
        $proposal->valid_until = $validated['valid_until'] !== '' ? $validated['valid_until'] : null;
        $proposal->status = $validated['status'];
        $proposal->currency_id = $validated['currencyId'] !== null ? (int) $validated['currencyId'] : null;
        $proposal->sub_total = (string) $validated['sub_total'];
        $proposal->discount = (string) $validated['discount'];
        $proposal->discount_type = $validated['discount_type'];
        $proposal->tax = (string) $validated['tax'];
        $proposal->total = (string) $validated['total'];
        $proposal->terms_conditions = $validated['terms_conditions'] !== '' ? $validated['terms_conditions'] : null;
        $proposal->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $proposal->approved_by = $validated['approvedById'] !== null ? (int) $validated['approvedById'] : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $proposal->created_by = $userId;
        }
        $proposal->updated_by = $userId;

        $proposal->save();

        $this->proposalId = $proposal->id;

        $this->dispatch('proposal-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-proposal');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Proposal updated' : 'Proposal created',
            message: $isUpdate
                ? 'The proposal has been updated.'
                : 'The proposal has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'proposal_number' => ['required', 'string', 'max:255', Rule::unique('proposals', 'proposal_number')->ignore($this->proposalId)],
            'leadId' => ['nullable', 'integer', 'exists:leads,id'],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'valid_until' => ['nullable', 'date'],
            'status' => ['required', 'string', Rule::in(['draft', 'sent', 'accepted', 'declined', 'expired'])],
            'currencyId' => ['nullable', 'integer', 'exists:currencies,id'],
            'sub_total' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'string', Rule::in(['fixed', 'percent'])],
            'tax' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'terms_conditions' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'approvedById' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'proposalId',
            'proposal_number',
            'leadId',
            'companyId',
            'title',
            'description',
            'valid_until',
            'status',
            'currencyId',
            'sub_total',
            'discount',
            'discount_type',
            'tax',
            'total',
            'terms_conditions',
            'notes',
            'approvedById',
        ]);

        $this->status = 'draft';
        $this->sub_total = '0';
        $this->discount = '0';
        $this->discount_type = 'fixed';
        $this->tax = '0';
        $this->total = '0';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-proposal"
    :title="$proposalId ? 'Edit Proposal' : 'New Proposal'"
    :subheading="$proposalId ? 'Update proposal details.' : 'Create a new proposal.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Proposal Number"
                placeholder="PROP-001"
                wire:model.live.debounce.300ms="proposal_number"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Title"
                placeholder="Proposal Title"
                wire:model.live.debounce.300ms="title"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="leadId"
                label="Lead"
                placeholder="Choose lead..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No lead</flux:select.option>
                @foreach (Lead::query()->orderBy('name')->get(['id', 'name']) as $leadOption)
                    <flux:select.option value="{{ $leadOption->id }}" wire:key="proposal-lead-{{ $leadOption->id }}">
                        {{ $leadOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="companyId"
                label="Company"
                placeholder="Choose company..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No company</flux:select.option>
                @foreach (Company::query()->orderBy('name')->get(['id', 'name']) as $companyOption)
                    <flux:select.option value="{{ $companyOption->id }}" wire:key="proposal-company-{{ $companyOption->id }}">
                        {{ $companyOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <flux:textarea
        label="Description"
        placeholder="Description..."
        wire:model.live.debounce.300ms="description"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Valid Until"
                type="date"
                wire:model.live="valid_until"
            />
        </div>
        <div class="md:col-span-4">
            <flux:select wire:model.live="status" label="Status">
                <flux:select.option value="draft">Draft</flux:select.option>
                <flux:select.option value="sent">Sent</flux:select.option>
                <flux:select.option value="accepted">Accepted</flux:select.option>
                <flux:select.option value="declined">Declined</flux:select.option>
                <flux:select.option value="expired">Expired</flux:select.option>
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="currencyId"
                label="Currency"
                placeholder="Choose currency..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No currency</flux:select.option>
                @foreach (Currency::query()->orderBy('code')->get(['id', 'code']) as $currencyOption)
                    <flux:select.option value="{{ $currencyOption->id }}" wire:key="proposal-currency-{{ $currencyOption->id }}">
                        {{ $currencyOption->code }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-3">
            <flux:input
                label="Sub Total"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="sub_total"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Discount"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="discount"
            />
        </div>
        <div class="md:col-span-3">
            <flux:select wire:model.live="discount_type" label="Discount Type">
                <flux:select.option value="fixed">Fixed</flux:select.option>
                <flux:select.option value="percent">Percent</flux:select.option>
            </flux:select>
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Tax"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="tax"
            />
        </div>
    </div>

    <flux:input
        label="Total"
        type="number"
        min="0"
        step="0.01"
        wire:model.live.debounce.200ms="total"
    />

    <flux:textarea
        label="Terms & Conditions"
        placeholder="Terms..."
        wire:model.live.debounce.300ms="terms_conditions"
    />

    <flux:textarea
        label="Notes"
        placeholder="Notes..."
        wire:model.live.debounce.300ms="notes"
    />

    <flux:select
        wire:model.live="approvedById"
        label="Approved By"
        placeholder="Select approver..."
        searchable
        variant="listbox"
    >
        <flux:select.option value="">No approver</flux:select.option>
        @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
            <flux:select.option value="{{ $userOption->id }}" wire:key="proposal-approved-{{ $userOption->id }}">
                {{ $userOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>
</x-app.modal.form>
