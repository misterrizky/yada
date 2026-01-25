<?php
use function Laravel\Folio\name;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\WithPagination;

name('app.country');

new class extends Component {
    use WithPagination;
    
    public string $search = '';
    public string $sortBy = 'name';
    public string $sortDirection = 'asc';

    public function sort(string $column): void {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    #[\Livewire\Attributes\Computed]
    public function collections(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return \App\Models\Regional\Country::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('iso2', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('phone_code', 'like', '%' . $search . '%')
                        ->orWhere('region', 'like', '%' . $search . '%')
                        ->orWhere('subregion', 'like', '%' . $search . '%');
                });
            })
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(10);
    }
}
?>
<x-layouts.app :title="__('Regional : Country')">
    @volt
    <flux:main>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Master</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Regional</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Country</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <flux:heading class="mt-5" size="xl" level="1">Country</flux:heading>
                <div class="flex items-center flex-wrap gap-1.5 font-medium">
                    <span class="text-base text-secondary-foreground">
                        All Country:
                    </span>
                    <span class="text-base text-foreground font-medium me-2">
                        49,053
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <flux:input wire:model.live="search" size="lg" icon="magnifying-glass" kbd="⌘K" placeholder="Filter by..." clearable />
                <flux:button variant="filled">Import CSV</flux:button>
                <flux:button :href="route('app.country.create')" wire:navigate variant="primary" color="sky">Add Country</flux:button>
            </div>
        </div>
        <flux:separator variant="subtle" />
        <flux:context>
            <div wire:loading wire:target="search,sort,gotoPage,nextPage,previousPage">
                @include('livewire.apps.skeleton.table', [
                    'columns' => ['Code', 'Name', 'Phone code', 'Region', 'Subregion', 'Status'],
                ])
            </div>
            <flux:table wire:loading.remove wire:target="search,sort,gotoPage,nextPage,previousPage" :paginate="$this->collections">
                <flux:table.columns>
                    <flux:table.column sortable :sorted="$sortBy === 'iso2'" :direction="$sortDirection" wire:click="sort('iso2')">Code</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">Name</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'phone_code'" :direction="$sortDirection" wire:click="sort('phone_code')">Phone code</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'region'" :direction="$sortDirection" wire:click="sort('region')">Region</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'subregion'" :direction="$sortDirection" wire:click="sort('subregion')">Subregion</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($this->collections as $collection)
                        <flux:table.row :key="$collection->id">
                            <flux:table.cell class="flex items-center gap-3 strong">
                                {{ $collection->iso2 }}
                            </flux:table.cell>
                            <flux:table.cell class="strong whitespace-nowrap">{{ $collection->name }}</flux:table.cell>
                            <flux:table.cell variant="strong">{{ $collection->phone_code }}</flux:table.cell>
                            <flux:table.cell variant="strong">{{ $collection->region }}</flux:table.cell>
                            <flux:table.cell variant="strong">{{ $collection->subregion }}</flux:table.cell>
                            @php
                            $color = $collection->status == 1 ? 'lime' : 'red';
                            $status = $collection->status == 1 ? 'Active' : 'Not Active';
                            @endphp
                            <flux:table.cell>
                                <flux:badge size="sm" :color="$color" inset="top bottom">{{ $status }}</flux:badge>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
            <flux:menu wire:loading.remove wire:target="search,sort,gotoPage,nextPage,previousPage">
                <flux:menu.item icon="plus">New post</flux:menu.item>
                <flux:menu.separator />
                <flux:menu.submenu heading="Sort by">
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Name</flux:menu.radio>
                        <flux:menu.radio>Date</flux:menu.radio>
                        <flux:menu.radio>Popularity</flux:menu.radio>
                    </flux:menu.radio.group>
                </flux:menu.submenu>
                <flux:menu.submenu heading="Filter">
                    <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
                    <flux:menu.checkbox checked>Published</flux:menu.checkbox>
                    <flux:menu.checkbox>Archived</flux:menu.checkbox>
                </flux:menu.submenu>
                <flux:menu.separator />
                <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
            </flux:menu>
        </flux:context>
    </flux:main>
    @endvolt
</x-layouts.app>
