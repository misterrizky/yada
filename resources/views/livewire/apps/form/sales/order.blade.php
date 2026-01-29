<?php

use App\Models\CRM\Company;
use App\Models\Regional\Currency;
use App\Models\Sales\Contract;
use App\Models\Sales\Order;
use App\Models\Sales\Quotation;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $orderId = null;
    public string $order_number = '';
    public ?int $companyId = null;
    public ?int $quotationId = null;
    public ?int $contractId = null;
    public string $order_date = '';
    public string $expected_delivery_date = '';
    public ?int $currencyId = null;
    public string $sub_total = '0';
    public string $discount = '0';
    public string $discount_type = 'fixed';
    public string $tax = '0';
    public string $total = '0';
    public string $status = 'pending';
    public string $delivery_address = '';
    public string $notes = '';
    public ?int $approvedById = null;

    #[On('order-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('order-edit')]
    public function startEdit(int $orderId): void
    {
        $order = Order::query()->findOrFail($orderId);

        $this->orderId = $order->id;
        $this->order_number = (string) $order->order_number;
        $this->companyId = $order->company_id !== null ? (int) $order->company_id : null;
        $this->quotationId = $order->quotation_id !== null ? (int) $order->quotation_id : null;
        $this->contractId = $order->contract_id !== null ? (int) $order->contract_id : null;
        $this->order_date = $order->order_date ? (string) $order->order_date : '';
        $this->expected_delivery_date = $order->expected_delivery_date ? (string) $order->expected_delivery_date : '';
        $this->currencyId = $order->currency_id !== null ? (int) $order->currency_id : null;
        $this->sub_total = (string) $order->sub_total;
        $this->discount = (string) $order->discount;
        $this->discount_type = (string) $order->discount_type;
        $this->tax = (string) $order->tax;
        $this->total = (string) $order->total;
        $this->status = (string) $order->status;
        $this->delivery_address = (string) ($order->delivery_address ?? '');
        $this->notes = (string) ($order->notes ?? '');
        $this->approvedById = $order->approved_by !== null ? (int) $order->approved_by : null;

        $this->dispatch('modal-show', name: 'form-order');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->orderId !== null;

        $order = $isUpdate
            ? Order::query()->findOrFail($this->orderId)
            : new Order();

        if (! $isUpdate) {
            $order->ulid = (string) Str::ulid();
        }

        $order->order_number = $validated['order_number'];
        $order->company_id = $validated['companyId'] !== null ? (int) $validated['companyId'] : null;
        $order->quotation_id = $validated['quotationId'] !== null ? (int) $validated['quotationId'] : null;
        $order->contract_id = $validated['contractId'] !== null ? (int) $validated['contractId'] : null;
        $order->order_date = $validated['order_date'];
        $order->expected_delivery_date = $validated['expected_delivery_date'] !== '' ? $validated['expected_delivery_date'] : null;
        $order->currency_id = $validated['currencyId'] !== null ? (int) $validated['currencyId'] : null;
        $order->sub_total = (string) $validated['sub_total'];
        $order->discount = (string) $validated['discount'];
        $order->discount_type = $validated['discount_type'];
        $order->tax = (string) $validated['tax'];
        $order->total = (string) $validated['total'];
        $order->status = $validated['status'];
        $order->delivery_address = $validated['delivery_address'] !== '' ? $validated['delivery_address'] : null;
        $order->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $order->approved_by = $validated['approvedById'] !== null ? (int) $validated['approvedById'] : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $order->created_by = $userId;
        }
        $order->updated_by = $userId;

        $order->save();

        $this->orderId = $order->id;

        $this->dispatch('order-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-order');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Order updated' : 'Order created',
            message: $isUpdate
                ? 'The order has been updated.'
                : 'The order has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'order_number' => ['required', 'string', 'max:255', Rule::unique('orders', 'order_number')->ignore($this->orderId)],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
            'quotationId' => ['nullable', 'integer', 'exists:quotations,id'],
            'contractId' => ['nullable', 'integer', 'exists:contracts,id'],
            'order_date' => ['required', 'date'],
            'expected_delivery_date' => ['nullable', 'date'],
            'currencyId' => ['nullable', 'integer', 'exists:currencies,id'],
            'sub_total' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'string', Rule::in(['fixed', 'percent'])],
            'tax' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])],
            'delivery_address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'approvedById' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'orderId',
            'order_number',
            'companyId',
            'quotationId',
            'contractId',
            'order_date',
            'expected_delivery_date',
            'currencyId',
            'sub_total',
            'discount',
            'discount_type',
            'tax',
            'total',
            'status',
            'delivery_address',
            'notes',
            'approvedById',
        ]);

        $this->order_date = now()->toDateString();
        $this->expected_delivery_date = '';
        $this->status = 'pending';
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
    name="form-order"
    :title="$orderId ? 'Edit Order' : 'New Order'"
    :subheading="$orderId ? 'Update order details.' : 'Create a new order.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Order Number"
                placeholder="ORD-001"
                wire:model.live.debounce.300ms="order_number"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Order Date"
                type="date"
                wire:model.live="order_date"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Expected Delivery"
                type="date"
                wire:model.live="expected_delivery_date"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="companyId"
                label="Company"
                placeholder="Choose company..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No company</flux:select.option>
                @foreach (Company::query()->orderBy('name')->get(['id', 'name']) as $companyOption)
                    <flux:select.option value="{{ $companyOption->id }}" wire:key="order-company-{{ $companyOption->id }}">
                        {{ $companyOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="quotationId"
                label="Quotation"
                placeholder="Choose quotation..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No quotation</flux:select.option>
                @foreach (Quotation::query()->orderBy('quotation_number')->get(['id', 'quotation_number']) as $quotationOption)
                    <flux:select.option value="{{ $quotationOption->id }}" wire:key="order-quotation-{{ $quotationOption->id }}">
                        {{ $quotationOption->quotation_number }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="contractId"
                label="Contract"
                placeholder="Choose contract..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No contract</flux:select.option>
                @foreach (Contract::query()->orderBy('contract_number')->get(['id', 'contract_number']) as $contractOption)
                    <flux:select.option value="{{ $contractOption->id }}" wire:key="order-contract-{{ $contractOption->id }}">
                        {{ $contractOption->contract_number }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
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
                    <flux:select.option value="{{ $currencyOption->id }}" wire:key="order-currency-{{ $currencyOption->id }}">
                        {{ $currencyOption->code }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select wire:model.live="status" label="Status">
                <flux:select.option value="pending">Pending</flux:select.option>
                <flux:select.option value="confirmed">Confirmed</flux:select.option>
                <flux:select.option value="processing">Processing</flux:select.option>
                <flux:select.option value="shipped">Shipped</flux:select.option>
                <flux:select.option value="delivered">Delivered</flux:select.option>
                <flux:select.option value="cancelled">Cancelled</flux:select.option>
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="approvedById"
                label="Approved By"
                placeholder="Select approver..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No approver</flux:select.option>
                @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
                    <flux:select.option value="{{ $userOption->id }}" wire:key="order-approved-{{ $userOption->id }}">
                        {{ $userOption->name }}
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
        label="Delivery Address"
        placeholder="Delivery address..."
        wire:model.live.debounce.300ms="delivery_address"
    />

    <flux:textarea
        label="Notes"
        placeholder="Notes..."
        wire:model.live.debounce.300ms="notes"
    />
</x-app.modal.form>
