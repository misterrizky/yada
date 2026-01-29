<?php

use App\Models\Master\Product;
use App\Models\Master\Solution;
use App\Models\Sales\Order;
use App\Models\Sales\OrderItem;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $orderItemId = null;
    public ?int $orderId = null;
    public string $orderNumber = '';
    public bool $isOrderLocked = false;

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
    public int $order_column = 0;

    public function mount(): void
    {
        $this->syncOrderFromRoute();
    }

    #[On('order-item-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncOrderFromRoute();
    }

    #[On('order-item-edit')]
    public function startEdit(int $orderItemId): void
    {
        $item = OrderItem::query()->with('order')->findOrFail($orderItemId);

        $this->orderItemId = $item->id;
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
        $this->order_column = (int) $item->order_column;

        if ($item->order) {
            $this->setOrder($item->order);
        }

        $this->dispatch('modal-show', name: 'form-order-item');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->orderItemId !== null;

        $item = $isUpdate
            ? OrderItem::query()->findOrFail($this->orderItemId)
            : new OrderItem();

        $item->order_id = (int) $validated['orderId'];
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
        $item->order_column = (int) $validated['order_column'];
        $item->save();

        $this->orderItemId = $item->id;

        $this->dispatch('order-item-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-order-item');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Order item updated' : 'Order item created',
            message: $isUpdate
                ? 'The order item has been updated.'
                : 'The order item has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'orderId' => ['required', 'integer', 'exists:orders,id'],
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
            'order_column' => ['required', 'integer', 'min:0'],
        ];
    }

    private function syncOrderFromRoute(): void
    {
        if ($this->orderId !== null) {
            return;
        }

        $order = request()->route('order');

        if ($order instanceof Order) {
            $this->setOrder($order);
        }
    }

    private function setOrder(Order $order): void
    {
        $this->orderId = $order->id;
        $this->orderNumber = (string) $order->order_number;
        $this->isOrderLocked = true;
    }

    private function resetForm(): void
    {
        $this->reset([
            'orderItemId',
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
            'order_column',
        ]);

        $this->quantity = '1';
        $this->unit_price = '0';
        $this->discount = '0';
        $this->discount_type = 'fixed';
        $this->tax_rate = '0';
        $this->amount = '0';
        $this->order_column = 0;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-order-item"
    :title="$orderItemId ? 'Edit Order Item' : 'New Order Item'"
    :subheading="$orderNumber !== '' ? 'For order ' . $orderNumber . '.' : 'Attach this item to an order.'"
    submit="save"
    close="resetModal"
>
    @if ($isOrderLocked)
        <flux:input
            label="Order"
            wire:model.live="orderNumber"
            placeholder="Order"
            disabled
        />
    @else
        <flux:select
            wire:model.live="orderId"
            label="Order"
            placeholder="Choose order..."
            searchable
            variant="listbox"
        >
            <flux:select.option value="">Choose order</flux:select.option>
            @foreach (Order::query()->orderBy('order_number')->get(['id', 'order_number']) as $orderOption)
                <flux:select.option value="{{ $orderOption->id }}" wire:key="order-item-order-{{ $orderOption->id }}">
                    {{ $orderOption->order_number }}
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
                    <flux:select.option value="{{ $productOption->id }}" wire:key="order-item-product-{{ $productOption->id }}">
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
                    <flux:select.option value="{{ $solutionOption->id }}" wire:key="order-item-solution-{{ $solutionOption->id }}">
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
        wire:model.live.debounce.200ms="order_column"
    />
</x-app.modal.form>
