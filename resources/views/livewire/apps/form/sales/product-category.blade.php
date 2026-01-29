<?php

use App\Models\Master\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $productCategoryId = null;
    public ?int $parentId = null;
    public string $name = '';
    public string $slug = '';
    public string $short_desc = '';
    public string $long_desc = '';
    public string $thumbnail = '';
    public int $order = 0;
    public int $is_active = 1;

    public function updatedName(string $value): void
    {
        if ($this->slug === '') {
            $this->slug = Str::slug($value);
        }
    }

    #[On('product-category-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('product-category-edit')]
    public function startEdit(int $productCategoryId): void
    {
        $category = ProductCategory::query()->findOrFail($productCategoryId);

        $this->productCategoryId = $category->id;
        $this->parentId = $category->parent_id !== null ? (int) $category->parent_id : null;
        $this->name = (string) $category->name;
        $this->slug = (string) $category->slug;
        $this->short_desc = (string) ($category->short_desc ?? '');
        $this->long_desc = (string) ($category->long_desc ?? '');
        $this->thumbnail = (string) ($category->thumbnail ?? '');
        $this->order = (int) $category->order;
        $this->is_active = (int) $category->is_active;

        $this->dispatch('modal-show', name: 'form-product-category');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->productCategoryId !== null;

        $category = $isUpdate
            ? ProductCategory::query()->findOrFail($this->productCategoryId)
            : new ProductCategory();

        if (! $isUpdate) {
            $category->ulid = (string) Str::ulid();
        }

        $category->parent_id = $validated['parentId'] !== null ? (int) $validated['parentId'] : null;
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->short_desc = $validated['short_desc'] !== '' ? $validated['short_desc'] : null;
        $category->long_desc = $validated['long_desc'] !== '' ? $validated['long_desc'] : null;
        $category->thumbnail = $validated['thumbnail'] !== '' ? $validated['thumbnail'] : null;
        $category->order = (int) $validated['order'];
        $category->is_active = (int) $validated['is_active'];
        $category->save();

        $this->productCategoryId = $category->id;

        $this->dispatch('product-category-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-product-category');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Product category updated' : 'Product category created',
            message: $isUpdate
                ? 'The product category has been updated.'
                : 'The product category has been created.'
        );
    }

    private function rules(): array
    {
        $notSelf = $this->productCategoryId ? [$this->productCategoryId] : [];

        return [
            'parentId' => ['nullable', 'integer', 'exists:product_categories,id', Rule::notIn($notSelf)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('product_categories', 'slug')->ignore($this->productCategoryId)],
            'short_desc' => ['nullable', 'string'],
            'long_desc' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'productCategoryId',
            'parentId',
            'name',
            'slug',
            'short_desc',
            'long_desc',
            'thumbnail',
            'order',
            'is_active',
        ]);

        $this->order = 0;
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
    name="form-product-category"
    :title="$productCategoryId ? 'Edit Product Category' : 'New Product Category'"
    :subheading="$productCategoryId ? 'Update product category details.' : 'Add a new product category to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:select
        wire:model.live="parentId"
        label="Parent Category"
        placeholder="No parent"
        searchable
        variant="listbox"
    >
        <flux:select.option value="">No parent</flux:select.option>
        @foreach (ProductCategory::query()->when($productCategoryId, fn ($q) => $q->whereKeyNot($productCategoryId))->orderBy('name')->get(['id', 'name']) as $parentOption)
            <flux:select.option value="{{ $parentOption->id }}" wire:key="product-category-parent-{{ $parentOption->id }}">
                {{ $parentOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-7">
            <flux:input
                label="Name"
                placeholder="Software"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-5">
            <flux:input
                label="Slug"
                placeholder="software"
                wire:model.live.debounce.300ms="slug"
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

    <flux:input
        label="Order"
        type="number"
        min="0"
        wire:model.live.debounce.200ms="order"
    />

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_active" label="Status">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Active" />
                <flux:radio value="0" label="Inactive" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
