<?php

use App\Models\Master\Product;
use App\Models\Master\ProductCategory;
use App\Models\Master\ProductUnit;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $productId = null;
    public ?int $categoryId = null;
    public ?int $unitId = null;
    public string $sku = '';
    public string $name = '';
    public string $short_desc = '';
    public string $long_desc = '';
    public string $thumbnail = '';
    public string $purchase_price = '0';
    public string $selling_price = '0';
    public string $tax_rate = '0';
    public int $is_purchasable = 1;
    public int $is_sellable = 1;
    public int $is_active = 1;

    #[On('product-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('product-edit')]
    public function startEdit(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);

        $this->productId = $product->id;
        $this->categoryId = $product->category_id !== null ? (int) $product->category_id : null;
        $this->unitId = $product->unit_id !== null ? (int) $product->unit_id : null;
        $this->sku = (string) ($product->sku ?? '');
        $this->name = (string) $product->name;
        $this->short_desc = (string) ($product->short_desc ?? '');
        $this->long_desc = (string) ($product->long_desc ?? '');
        $this->thumbnail = (string) ($product->thumbnail ?? '');
        $this->purchase_price = (string) $product->purchase_price;
        $this->selling_price = (string) $product->selling_price;
        $this->tax_rate = (string) $product->tax_rate;
        $this->is_purchasable = (int) $product->is_purchasable;
        $this->is_sellable = (int) $product->is_sellable;
        $this->is_active = (int) $product->is_active;

        $this->dispatch('modal-show', name: 'form-product');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->productId !== null;

        $product = $isUpdate
            ? Product::query()->findOrFail($this->productId)
            : new Product();

        if (! $isUpdate) {
            $product->ulid = (string) Str::ulid();
        }

        $product->category_id = $validated['categoryId'] !== null ? (int) $validated['categoryId'] : null;
        $product->unit_id = $validated['unitId'] !== null ? (int) $validated['unitId'] : null;
        $product->sku = $validated['sku'] !== '' ? $validated['sku'] : null;
        $product->name = $validated['name'];
        $product->short_desc = $validated['short_desc'] !== '' ? $validated['short_desc'] : null;
        $product->long_desc = $validated['long_desc'] !== '' ? $validated['long_desc'] : null;
        $product->thumbnail = $validated['thumbnail'] !== '' ? $validated['thumbnail'] : null;
        $product->purchase_price = (string) $validated['purchase_price'];
        $product->selling_price = (string) $validated['selling_price'];
        $product->tax_rate = (string) $validated['tax_rate'];
        $product->is_purchasable = (int) $validated['is_purchasable'];
        $product->is_sellable = (int) $validated['is_sellable'];
        $product->is_active = (int) $validated['is_active'];
        $product->save();

        $this->productId = $product->id;

        $this->dispatch('product-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-product');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Product updated' : 'Product created',
            message: $isUpdate
                ? 'The product has been updated.'
                : 'The product has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'categoryId' => ['nullable', 'integer', 'exists:product_categories,id'],
            'unitId' => ['nullable', 'integer', 'exists:product_units,id'],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->productId)],
            'name' => ['required', 'string', 'max:255'],
            'short_desc' => ['nullable', 'string'],
            'long_desc' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'is_purchasable' => ['required', 'integer', 'in:0,1'],
            'is_sellable' => ['required', 'integer', 'in:0,1'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'productId',
            'categoryId',
            'unitId',
            'sku',
            'name',
            'short_desc',
            'long_desc',
            'thumbnail',
            'purchase_price',
            'selling_price',
            'tax_rate',
            'is_purchasable',
            'is_sellable',
            'is_active',
        ]);

        $this->purchase_price = '0';
        $this->selling_price = '0';
        $this->tax_rate = '0';
        $this->is_purchasable = 1;
        $this->is_sellable = 1;
        $this->is_active = 1;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-product"
    :title="$productId ? 'Edit Product' : 'New Product'"
    :subheading="$productId ? 'Update product details.' : 'Add a new product to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="categoryId"
                label="Category"
                placeholder="Choose category..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No category</flux:select.option>
                @foreach (ProductCategory::query()->orderBy('name')->get(['id', 'name']) as $categoryOption)
                    <flux:select.option value="{{ $categoryOption->id }}" wire:key="product-category-{{ $categoryOption->id }}">
                        {{ $categoryOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="unitId"
                label="Unit"
                placeholder="Choose unit..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No unit</flux:select.option>
                @foreach (ProductUnit::query()->orderBy('name')->get(['id', 'name']) as $unitOption)
                    <flux:select.option value="{{ $unitOption->id }}" wire:key="product-unit-{{ $unitOption->id }}">
                        {{ $unitOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="SKU"
                placeholder="SKU-001"
                wire:model.live.debounce.300ms="sku"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Product Name"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:input
        label="Thumbnail URL"
        placeholder="https://..."
        wire:model.live.debounce.300ms="thumbnail"
        autocomplete="off"
    />

    <flux:textarea
        label="Short Description"
        placeholder="Short description..."
        wire:model.live.debounce.300ms="short_desc"
    />

    <flux:textarea
        label="Long Description"
        placeholder="Long description..."
        wire:model.live.debounce.300ms="long_desc"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Purchase Price"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="purchase_price"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Selling Price"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="selling_price"
            />
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
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_purchasable" label="Purchasable">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Purchasable" />
                <flux:radio value="0" label="Not Purchasable" />
            </div>
        </flux:radio.group>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_sellable" label="Sellable">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Sellable" />
                <flux:radio value="0" label="Not Sellable" />
            </div>
        </flux:radio.group>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_active" label="Status">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Active" />
                <flux:radio value="0" label="Inactive" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
