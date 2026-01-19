<?php

use App\Models\PM\Project;
use App\Models\Master\Industry;
use function Livewire\Volt\{computed, state};

state([
    'search' => '',
    'selectedIndustries' => [],
    'showAllIndustries' => false,
]);

$industries = computed(
    fn() => Industry::whereHas('companies.projects', function ($q) {
        $q->where('is_featured', 0);
    })
        ->orderBy('name')
        ->get(),
);
$visibleIndustries = computed(fn() => $this->showAllIndustries ? $this->industries() : $this->industries()->take(6));

$projects = computed(function () {
    return Project::query()
        ->where('is_featured', 0) // ⬅️ hanya project non-featured
        ->when($this->selectedIndustries, function ($query) {
            $query->whereHas('company.industry', function ($q) {
                $q->whereIn('id', $this->selectedIndustries);
            });
        })
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('company', function ($c) {
                        $c->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        })
        ->with(['projectGalleries', 'company.industry'])
        ->get();
});

?>
<main class="mx-auto max-w-2xl lg:max-w-7xl lg:px-8">

    <!-- HEADER -->
    <div class="border-gray-200 pb-10 text-center">
        <p class="mt-4 text-base text-gray-500">
        <h1 class="text-4xl font-bold tracking-tight">Our Experience</h1>
Building Solutions for Diverse Industries
        </p>
    </div>

    <div class="pt-12 pb-24 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
        <aside>
            <button type="button" class="inline-flex items-center lg:hidden">
                <span class="text-sm font-medium text-gray-300">Filters</span>
            </button>

            <div class="mt-4">
                <input type="email" placeholder="Search" wire:model.live.debounce.300ms="search"
                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-white placeholder:text-gray-500">
            </div>

            <div class="hidden lg:block">
                <form class="divide-y divide-white/10 mt-10">
                    <div class="py-6">
                        <legend class="block text-sm font-medium">Industries</legend>

                        <div class="space-y-3 pt-4">
                            @foreach ($this->visibleIndustries as $industry)
                                <label class="flex gap-2 text-sm text-gray-400">
                                    <input type="checkbox" value="{{ $industry->id }}"
                                        wire:model.live="selectedIndustries">
                                    {{ $industry->name }}
                                </label>
                            @endforeach
                        </div>

                        @if ($this->industries->count() > 6)
                            <button type="button" wire:click="$toggle('showAllIndustries')"
                                class="mt-3 text-sm text-indigo-400 hover:underline">
                                {{ $this->showAllIndustries ? 'Show less' : 'Show more' }}
                            </button>
                        @endif

                    </div>
                </form>
            </div>
        </aside>

        <!-- ================= PRODUCTS ================= -->
        <section class="mt-6 lg:col-span-2 xl:col-span-3">

            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 gap-x-6">

                <!-- PRODUCT -->
                @foreach ($this->projects as $item)
                    <div class="product-item group flex flex-col rounded-lg bg-dark-900 overflow-hidden">
                        <img src="{{ $item->projectGalleries->first()?->file_path
                            ? asset('storage/' . $item->projectGalleries->first()->file_path)
                            : asset('assets/media/industries/pexels-pixabay-257700.jpg') }}"
                            class="aspect-[10/11] object-cover">

                        <div class="p-4">
                            <h3 class="font-medium">{{ $item->name ?? 'Title Here' }}</h3>
                            <p class="text-sm text-gray-400">{{ $item->description ?? 'Description Here' }}</p>
                        </div>
                    </div>
                @endforeach


            </div>

            <!-- ================= PAGINATION ================= -->
            <nav class="mt-12 flex items-center justify-between border-t border-white/10 pt-4">
                <button id="prevBtn" class="text-gray-400 hover:text-white">
                    ← Previous
                </button>

                <div id="pageNumbers" class="hidden md:flex gap-2"></div>

                <button id="nextBtn" class="text-gray-400 hover:text-white">
                    Next →
                </button>
            </nav>

        </section>
    </div>
</main>
<script>
function initPagination() {
    const items = document.querySelectorAll('.product-item');
    if (!items.length) return; // kalau bukan halaman works, stop

    const itemsPerPage = 4;
    let currentPage = 1;

    const totalPages = Math.ceil(items.length / itemsPerPage);
    const pageNumbers = document.getElementById('pageNumbers');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (!pageNumbers || !prevBtn || !nextBtn) return;

    function showPage(page) {
        currentPage = page;

        items.forEach((item, index) => {
            item.style.display =
                index >= (page - 1) * itemsPerPage &&
                index < page * itemsPerPage
                    ? 'flex'
                    : 'none';
        });

        renderNumbers();
    }

    function renderNumbers() {
        pageNumbers.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className =
                `px-3 pt-2 text-sm border-t-2 ${i === currentPage
                    ? 'border-indigo-400 text-indigo-400'
                    : 'border-transparent text-gray-400 hover:text-white'
                }`;
            btn.onclick = () => showPage(i);
            pageNumbers.appendChild(btn);
        }
    }

    prevBtn.onclick = () => currentPage > 1 && showPage(currentPage - 1);
    nextBtn.onclick = () => currentPage < totalPages && showPage(currentPage + 1);

    showPage(1);
}

// Saat load pertama
document.addEventListener('DOMContentLoaded', initPagination);

// ✅ INI YANG KAMU TANYAKAN → untuk wire:navigate
document.addEventListener('livewire:navigated', () => {
    initPagination();
});
</script>



