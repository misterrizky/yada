<?php

use App\Models\Master\Product;
use App\Models\Master\Solution;
use App\Models\Sales\Proposal;
use App\Models\Sales\ProposalItem;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $proposalItemId = null;
    public ?int $proposalId = null;
    public string $proposalNumber = '';
    public bool $isProposalLocked = false;

    public ?int $productId = null;
    public ?int $solutionId = null;
    public string $item_name = '';
    public string $description = '';
    public string $quantity = '1';
    public string $unit = '';
    public string $unit_price = '0';
    public string $discount = '0';
    public string $discount_type = 'fixed';
    public string $tax_rate = '0';
    public string $amount = '0';
    public int $order = 0;

    public function mount(): void
    {
        $this->syncProposalFromRoute();
    }

    #[On('proposal-item-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncProposalFromRoute();
    }

    #[On('proposal-item-edit')]
    public function startEdit(int $proposalItemId): void
    {
        $item = ProposalItem::query()->with('proposal')->findOrFail($proposalItemId);

        $this->proposalItemId = $item->id;
        $this->productId = $item->product_id !== null ? (int) $item->product_id : null;
        $this->solutionId = $item->solution_id !== null ? (int) $item->solution_id : null;
        $this->item_name = (string) $item->item_name;
        $this->description = (string) ($item->description ?? '');
        $this->quantity = (string) $item->quantity;
        $this->unit = (string) ($item->unit ?? '');
        $this->unit_price = (string) $item->unit_price;
        $this->discount = (string) $item->discount;
        $this->discount_type = (string) $item->discount_type;
        $this->tax_rate = (string) $item->tax_rate;
        $this->amount = (string) $item->amount;
        $this->order = (int) $item->order;

        if ($item->proposal) {
            $this->setProposal($item->proposal);
        }

        $this->dispatch('modal-show', name: 'form-proposal-item');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->proposalItemId !== null;

        $item = $isUpdate
            ? ProposalItem::query()->findOrFail($this->proposalItemId)
            : new ProposalItem();

        $item->proposal_id = (int) $validated['proposalId'];
        $item->product_id = $validated['productId'] !== null ? (int) $validated['productId'] : null;
        $item->solution_id = $validated['solutionId'] !== null ? (int) $validated['solutionId'] : null;
        $item->item_name = $validated['item_name'];
        $item->description = $validated['description'] !== '' ? $validated['description'] : null;
        $item->quantity = (string) $validated['quantity'];
        $item->unit = $validated['unit'] !== '' ? $validated['unit'] : null;
        $item->unit_price = (string) $validated['unit_price'];
        $item->discount = (string) $validated['discount'];
        $item->discount_type = $validated['discount_type'];
        $item->tax_rate = (string) $validated['tax_rate'];
        $item->amount = (string) $validated['amount'];
        $item->order = (int) $validated['order'];
        $item->save();

        $this->proposalItemId = $item->id;

        $this->dispatch('proposal-item-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-proposal-item');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Proposal item updated' : 'Proposal item created',
            message: $isUpdate
                ? 'The proposal item has been updated.'
                : 'The proposal item has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'proposalId' => ['required', 'integer', 'exists:proposals,id'],
            'productId' => ['nullable', 'integer', 'exists:products,id'],
            'solutionId' => ['nullable', 'integer', 'exists:solutions,id'],
            'item_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'unit' => ['nullable', 'string', 'max:50'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'string', 'in:fixed,percent'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'order' => ['required', 'integer', 'min:0'],
        ];
    }

    private function syncProposalFromRoute(): void
    {
        if ($this->proposalId !== null) {
            return;
        }

        $proposal = request()->route('proposal');

        if ($proposal instanceof Proposal) {
            $this->setProposal($proposal);
        }
    }

    private function setProposal(Proposal $proposal): void
    {
        $this->proposalId = $proposal->id;
        $this->proposalNumber = (string) $proposal->proposal_number;
        $this->isProposalLocked = true;
    }

    private function resetForm(): void
    {
        $this->reset([
            'proposalItemId',
            'productId',
            'solutionId',
            'item_name',
            'description',
            'quantity',
            'unit',
            'unit_price',
            'discount',
            'discount_type',
            'tax_rate',
            'amount',
            'order',
        ]);

        $this->quantity = '1';
        $this->unit_price = '0';
        $this->discount = '0';
        $this->discount_type = 'fixed';
        $this->tax_rate = '0';
        $this->amount = '0';
        $this->order = 0;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-proposal-item"
    :title="$proposalItemId ? 'Edit Proposal Item' : 'New Proposal Item'"
    :subheading="$proposalNumber !== '' ? 'For proposal ' . $proposalNumber . '.' : 'Attach this item to a proposal.'"
    submit="save"
    close="resetModal"
>
    @if ($isProposalLocked)
        <flux:input
            label="Proposal"
            wire:model.live="proposalNumber"
            placeholder="Proposal"
            disabled
        />
    @else
        <flux:select
            wire:model.live="proposalId"
            label="Proposal"
            placeholder="Choose proposal..."
            searchable
            variant="listbox"
        >
            <flux:select.option value="">Choose proposal</flux:select.option>
            @foreach (Proposal::query()->orderBy('proposal_number')->get(['id', 'proposal_number']) as $proposalOption)
                <flux:select.option value="{{ $proposalOption->id }}" wire:key="proposal-item-proposal-{{ $proposalOption->id }}">
                    {{ $proposalOption->proposal_number }}
                </flux:select.option>
            @endforeach
        </flux:select>
    @endif

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="productId"
                label="Product"
                placeholder="Choose product..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No product</flux:select.option>
                @foreach (Product::query()->orderBy('name')->get(['id', 'name']) as $productOption)
                    <flux:select.option value="{{ $productOption->id }}" wire:key="proposal-item-product-{{ $productOption->id }}">
                        {{ $productOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="solutionId"
                label="Solution"
                placeholder="Choose solution..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No solution</flux:select.option>
                @foreach (Solution::query()->orderBy('name')->get(['id', 'name']) as $solutionOption)
                    <flux:select.option value="{{ $solutionOption->id }}" wire:key="proposal-item-solution-{{ $solutionOption->id }}">
                        {{ $solutionOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <flux:input
        label="Item Name"
        placeholder="Item name"
        wire:model.live.debounce.300ms="item_name"
        autocomplete="off"
    />

    <flux:textarea
        label="Description"
        placeholder="Description..."
        wire:model.live.debounce.300ms="description"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-3">
            <flux:input
                label="Quantity"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="quantity"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Unit"
                placeholder="Unit"
                wire:model.live.debounce.200ms="unit"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Unit Price"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="unit_price"
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
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select wire:model.live="discount_type" label="Discount Type">
                <flux:select.option value="fixed">Fixed</flux:select.option>
                <flux:select.option value="percent">Percent</flux:select.option>
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Tax Rate (%)"
                type="number"
                min="0"
                max="100"
                step="0.01"
                wire:model.live.debounce.200ms="tax_rate"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Amount"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="amount"
            />
        </div>
    </div>

    <flux:input
        label="Order"
        type="number"
        min="0"
        wire:model.live.debounce.200ms="order"
    />
</x-app.modal.form>
