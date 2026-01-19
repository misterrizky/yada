
<?php

use Illuminate\Pagination\LengthAwarePaginator;
use function Livewire\Volt\{computed, state, updated, usesPagination};

usesPagination();

state([
    'layout' => 'custom',
    'q' => '',
    'industries' => [],
    'types' => [],
    'perPage' => 12,
]);

state('layout')->locked();

updated([
    'q' => fn () => $this->resetPage(),
    'industries' => fn () => $this->resetPage(),
    'types' => fn () => $this->resetPage(),
    'perPage' => fn () => $this->resetPage(),
]);

$typeOptions = [
    ['label' => 'Web', 'value' => 'Web'],
    ['label' => 'Mobile', 'value' => 'Mobile'],
    ['label' => 'UX/UI', 'value' => 'UX/UI'],
    ['label' => 'AI', 'value' => 'AI'],
];

$industryOptions = [
    ['label' => 'Fintech', 'value' => 'finance'],
    ['label' => 'Retail', 'value' => 'retail'],
    ['label' => 'Logistics', 'value' => 'logistics'],
    ['label' => 'Healthcare', 'value' => 'healthcare'],
    ['label' => 'Education', 'value' => 'education'],
    ['label' => 'Energy', 'value' => 'energy'],
    ['label' => 'Hospitality', 'value' => 'hospitality'],
    ['label' => 'Media', 'value' => 'media'],
    ['label' => 'Agritech', 'value' => 'agritech'],
    ['label' => 'Public sector', 'value' => 'public-sector'],
    ['label' => 'Manufacturing', 'value' => 'manufacturing'],
    ['label' => 'Mobility', 'value' => 'mobility'],
];

$industryLabels = collect($industryOptions)
    ->mapWithKeys(fn ($item) => [$item['value'] => $item['label']])
    ->all();
$worksSeed = [
    [
        'id' => 1,
        'title' => 'Pulse Commerce Platform',
        'client' => 'NusaMart',
        'excerpt' => 'Unified store operations with live inventory sync and omnichannel checkout.',
        'cover_url' => 'assets/media/images/600x400/1.jpg',
        'industry' => 'retail',
        'types' => ['Web', 'UX/UI'],
        'year' => 2024,
        'slug' => 'pulse-commerce-platform',
    ],
    [
        'id' => 2,
        'title' => 'Cold Chain Control Center',
        'client' => 'Aruna Logistics',
        'excerpt' => 'Realtime fleet visibility and compliance alerts for cold storage routes.',
        'cover_url' => 'assets/media/images/600x400/2.jpg',
        'industry' => 'logistics',
        'types' => ['Web', 'AI'],
        'year' => 2023,
        'slug' => 'cold-chain-control-center',
    ],
    [
        'id' => 3,
        'title' => 'CarePath Telehealth',
        'client' => 'Sakura Health',
        'excerpt' => 'A mobile-first patient journey with scheduling and care plans.',
        'cover_url' => 'assets/media/images/600x400/3.jpg',
        'industry' => 'healthcare',
        'types' => ['Mobile', 'UX/UI'],
        'year' => 2024,
        'slug' => 'carepath-telehealth',
    ],
    [
        'id' => 4,
        'title' => 'Treasury Reconciliation Suite',
        'client' => 'Tempo Bank',
        'excerpt' => 'Automated reconciliation workflows with anomaly detection.',
        'cover_url' => 'assets/media/images/600x400/4.jpg',
        'industry' => 'finance',
        'types' => ['Web', 'AI'],
        'year' => 2022,
        'slug' => 'treasury-reconciliation-suite',
    ],
    [
        'id' => 5,
        'title' => 'Campus Learning Hub',
        'client' => 'Cendekia Edu',
        'excerpt' => 'Learning operations dashboard with multi-campus insights.',
        'cover_url' => 'assets/media/images/600x400/5.jpg',
        'industry' => 'education',
        'types' => ['Web', 'UX/UI'],
        'year' => 2023,
        'slug' => 'campus-learning-hub',
    ],
    [
        'id' => 6,
        'title' => 'GridOps Command',
        'client' => 'Merah Energy',
        'excerpt' => 'Operational command center for power generation and maintenance.',
        'cover_url' => 'assets/media/images/600x400/6.jpg',
        'industry' => 'energy',
        'types' => ['Web', 'AI'],
        'year' => 2024,
        'slug' => 'gridops-command',
    ],
    [
        'id' => 7,
        'title' => 'Skyline Guest App',
        'client' => 'Skyline Resorts',
        'excerpt' => 'Mobile concierge experience with in-room services and upsells.',
        'cover_url' => 'assets/media/images/600x400/7.jpg',
        'industry' => 'hospitality',
        'types' => ['Mobile', 'UX/UI'],
        'year' => 2022,
        'slug' => 'skyline-guest-app',
    ],
    [
        'id' => 8,
        'title' => 'StudioNow Creator Suite',
        'client' => 'Raya Media',
        'excerpt' => 'Creator studio tools for collaboration, review, and publishing.',
        'cover_url' => 'assets/media/images/600x400/8.jpg',
        'industry' => 'media',
        'types' => ['Web', 'UX/UI'],
        'year' => 2024,
        'slug' => 'studionow-creator-suite',
    ],
    [
        'id' => 9,
        'title' => 'HarvestSense Dashboard',
        'client' => 'Delta Agro',
        'excerpt' => 'Crop monitoring platform with predictive insights.',
        'cover_url' => 'assets/media/images/600x400/9.jpg',
        'industry' => 'agritech',
        'types' => ['Web', 'AI'],
        'year' => 2023,
        'slug' => 'harvestsense-dashboard',
    ],
    [
        'id' => 10,
        'title' => 'Civic Permit Portal',
        'client' => 'CityGov',
        'excerpt' => 'Digital permit workflow to reduce approval time.',
        'cover_url' => 'assets/media/images/600x400/10.jpg',
        'industry' => 'public-sector',
        'types' => ['Web', 'UX/UI'],
        'year' => 2022,
        'slug' => 'civic-permit-portal',
    ],
    [
        'id' => 11,
        'title' => 'Factory QA Console',
        'client' => 'Manuflex',
        'excerpt' => 'Quality management console with real-time scoring.',
        'cover_url' => 'assets/media/images/600x400/11.jpg',
        'industry' => 'manufacturing',
        'types' => ['Web', 'AI'],
        'year' => 2024,
        'slug' => 'factory-qa-console',
    ],
    [
        'id' => 12,
        'title' => 'Nimbus Mobility Pass',
        'client' => 'Nimbus Mobility',
        'excerpt' => 'Subscription experience for shared mobility fleets.',
        'cover_url' => 'assets/media/images/600x400/12.jpg',
        'industry' => 'mobility',
        'types' => ['Mobile', 'Web'],
        'year' => 2023,
        'slug' => 'nimbus-mobility-pass',
    ],
];
$caseStudiesSeed = [
    [
        'id' => 1,
        'title' => 'Reimagining retail fulfillment',
        'client' => 'NusaMart',
        'excerpt' => 'Built an order orchestration system that cut picking time by 34 percent.',
        'cover_url' => 'assets/media/images/600x600/1.jpg',
        'industry' => 'retail',
        'types' => ['Web', 'AI'],
        'year' => 2024,
        'slug' => 'reimagining-retail-fulfillment',
    ],
    [
        'id' => 2,
        'title' => 'Telehealth onboarding at scale',
        'client' => 'Sakura Health',
        'excerpt' => 'A redesigned patient intake reduced drop off and boosted completion.',
        'cover_url' => 'assets/media/images/600x600/2.jpg',
        'industry' => 'healthcare',
        'types' => ['Mobile', 'UX/UI'],
        'year' => 2023,
        'slug' => 'telehealth-onboarding-at-scale',
    ],
    [
        'id' => 3,
        'title' => 'Cold chain fleet visibility',
        'client' => 'Aruna Logistics',
        'excerpt' => 'Telemetry dashboards with proactive alerts for temperature breaches.',
        'cover_url' => 'assets/media/images/600x600/3.jpg',
        'industry' => 'logistics',
        'types' => ['Web', 'AI'],
        'year' => 2024,
        'slug' => 'cold-chain-fleet-visibility',
    ],
    [
        'id' => 4,
        'title' => 'Digital tax portal',
        'client' => 'CityGov',
        'excerpt' => 'Unified citizen portal that improved permit SLA visibility.',
        'cover_url' => 'assets/media/images/600x600/4.jpg',
        'industry' => 'public-sector',
        'types' => ['Web', 'UX/UI'],
        'year' => 2022,
        'slug' => 'digital-tax-portal',
    ],
    [
        'id' => 5,
        'title' => 'Banking app modernization',
        'client' => 'Tempo Bank',
        'excerpt' => 'Mobile refresh with enhanced security and biometric flows.',
        'cover_url' => 'assets/media/images/600x600/5.jpg',
        'industry' => 'finance',
        'types' => ['Mobile', 'UX/UI'],
        'year' => 2023,
        'slug' => 'banking-app-modernization',
    ],
    [
        'id' => 6,
        'title' => 'AI demand forecasting',
        'client' => 'Merah Energy',
        'excerpt' => 'Forecasting dashboards to align generation schedules with demand.',
        'cover_url' => 'assets/media/images/600x600/6.jpg',
        'industry' => 'energy',
        'types' => ['AI', 'Web'],
        'year' => 2024,
        'slug' => 'ai-demand-forecasting',
    ],
    [
        'id' => 7,
        'title' => 'Learning platform revamp',
        'client' => 'Cendekia Edu',
        'excerpt' => 'New UX for blended learning improved engagement across cohorts.',
        'cover_url' => 'assets/media/images/600x600/7.jpg',
        'industry' => 'education',
        'types' => ['Web', 'UX/UI'],
        'year' => 2022,
        'slug' => 'learning-platform-revamp',
    ],
    [
        'id' => 8,
        'title' => 'Hospitality guest journey',
        'client' => 'Skyline Resorts',
        'excerpt' => 'Mobile guest app with concierge services and in-room ordering.',
        'cover_url' => 'assets/media/images/600x600/8.jpg',
        'industry' => 'hospitality',
        'types' => ['Mobile', 'UX/UI'],
        'year' => 2023,
        'slug' => 'hospitality-guest-journey',
    ],
    [
        'id' => 9,
        'title' => 'Creator studio suite',
        'client' => 'Raya Media',
        'excerpt' => 'Collaborative review workflows for distributed content teams.',
        'cover_url' => 'assets/media/images/600x600/9.jpg',
        'industry' => 'media',
        'types' => ['Web', 'UX/UI'],
        'year' => 2024,
        'slug' => 'creator-studio-suite',
    ],
    [
        'id' => 10,
        'title' => 'Smart irrigation console',
        'client' => 'Delta Agro',
        'excerpt' => 'Sensor dashboards that reduced water usage across farms.',
        'cover_url' => 'assets/media/images/600x600/10.jpg',
        'industry' => 'agritech',
        'types' => ['AI', 'Web'],
        'year' => 2024,
        'slug' => 'smart-irrigation-console',
    ],
    [
        'id' => 11,
        'title' => 'Factory quality console',
        'client' => 'Manuflex',
        'excerpt' => 'Quality checks and alerts streamed into a single command view.',
        'cover_url' => 'assets/media/images/600x600/11.jpg',
        'industry' => 'manufacturing',
        'types' => ['Web', 'AI'],
        'year' => 2022,
        'slug' => 'factory-quality-console',
    ],
    [
        'id' => 12,
        'title' => 'Mobility subscription platform',
        'client' => 'Nimbus Mobility',
        'excerpt' => 'Membership experiences with automated billing and support.',
        'cover_url' => 'assets/media/images/600x600/12.jpg',
        'industry' => 'mobility',
        'types' => ['Mobile', 'Web'],
        'year' => 2023,
        'slug' => 'mobility-subscription-platform',
    ],
];

$featuredWorks = computed(fn () => collect($worksSeed)->take(6));

$caseStudies = computed(function () use ($caseStudiesSeed) {
    $query = trim(strtolower($this->q));
    $industryFilter = array_values(array_filter($this->industries ?? []));
    $typeFilter = array_values(array_filter($this->types ?? []));

    $filtered = collect($caseStudiesSeed)
        ->filter(function ($item) use ($query, $industryFilter, $typeFilter) {
            if ($query !== '') {
                $haystack = strtolower($item['title'].' '.$item['client'].' '.$item['excerpt'].' '.implode(' ', $item['types']).' '.$item['industry']);

                if (! str_contains($haystack, $query)) {
                    return false;
                }
            }

            if ($industryFilter && ! in_array($item['industry'], $industryFilter, true)) {
                return false;
            }

            if ($typeFilter && count(array_intersect($typeFilter, $item['types'])) === 0) {
                return false;
            }

            return true;
        })
        ->values();

    $perPage = max(1, (int) $this->perPage);
    $page = $this->getPage();
    $results = $filtered->slice(($page - 1) * $perPage, $perPage)->values();

    return new LengthAwarePaginator($results, $filtered->count(), $perPage, $page, [
        'path' => request()->url(),
        'query' => request()->query(),
    ]);
});

$hasFilters = computed(fn () => trim($this->q) !== '' || ! empty($this->industries) || ! empty($this->types));

$toggleType = function (string $type) {
    $types = $this->types ?? [];

    if (in_array($type, $types, true)) {
        $this->types = array_values(array_filter($types, fn ($value) => $value !== $type));
    } else {
        $this->types = array_values(array_unique(array_merge($types, [$type])));
    }

    $this->resetPage();
};

$clearFilters = function () {
    $this->q = '';
    $this->industries = [];
    $this->types = [];
    $this->perPage = 12;
    $this->resetPage();
};

?>

@php
    $isFlux = $layout === 'flux';
    $isMetronic = $layout === 'metronic';
@endphp

@if ($isFlux)
    <section class="mx-auto max-w-6xl px-6 py-16 sm:py-24" id="our-works">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <flux:heading size="lg">Our Works</flux:heading>
                <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                    Highlighted launches from teams across finance, healthcare, and logistics.
                </p>
            </div>
            <flux:button variant="outline" href="{{ route('web.contact') }}">Request a walkthrough</flux:button>
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredWorks as $item)
                <article class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900" wire:key="work-flux-{{ $item['id'] }}">
                    <a class="group block" href="{{ url('/works/' . $item['slug']) }}">
                        <img class="aspect-[4/3] w-full rounded-xl object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                        <div class="mt-4 space-y-2">
                            <div class="text-xs text-zinc-500">
                                {{ $item['client'] }} - {{ $industryLabels[$item['industry']] ?? $item['industry'] }} - {{ $item['year'] }}
                            </div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $item['title'] }}</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $item['excerpt'] }}</p>
                            <div class="flex flex-wrap gap-2 pt-1">
                                @foreach ($item['types'] as $type)
                                    <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-600 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300">
                                        {{ $type }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="border-t border-zinc-200/70 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900/40 sm:py-24" id="case-studies">
        <div class="mx-auto max-w-6xl px-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <flux:heading size="lg">Case Studies</flux:heading>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                        Filter by industry, service type, or keyword to find a relevant delivery story.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div class="min-w-[220px] flex-1">
                        <label class="sr-only" for="flux-search">Search</label>
                        <input id="flux-search" type="search" placeholder="Search case studies" class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-700 shadow-sm focus:border-emerald-500 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-200" wire:model.live.debounce.400ms="q" />
                    </div>
                    <details class="relative">
                        <summary class="cursor-pointer rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-700 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-200">
                            Industries
                        </summary>
                        <div class="absolute right-0 z-10 mt-2 w-60 rounded-lg border border-zinc-200 bg-white p-4 shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                            <div class="space-y-2">
                                @foreach ($industryOptions as $industry)
                                    <label class="flex items-center gap-2 text-sm text-zinc-700 dark:text-zinc-200">
                                        <input class="rounded border-zinc-300 text-emerald-500 focus:ring-emerald-500 dark:border-zinc-700" type="checkbox" value="{{ $industry['value'] }}" wire:model.live="industries" />
                                        <span>{{ $industry['label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </details>
                    <div>
                        <label class="sr-only" for="flux-per-page">Per page</label>
                        <select id="flux-per-page" class="rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-700 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-200" wire:model.live="perPage">
                            <option value="6">6 / page</option>
                            <option value="12">12 / page</option>
                            <option value="18">18 / page</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($typeOptions as $type)
                    <button type="button" class="rounded-full border px-3 py-1 text-xs font-semibold {{ in_array($type['value'], $types, true) ? 'border-emerald-500 bg-emerald-500 text-white' : 'border-zinc-200 bg-white text-zinc-600 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300' }}" wire:click="toggleType('{{ $type['value'] }}')">
                        {{ $type['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-xs text-zinc-500">
                <span>{{ $caseStudies->total() }} results</span>
                @if ($hasFilters)
                    <button type="button" class="text-emerald-600 hover:text-emerald-500" wire:click="clearFilters">Clear filters</button>
                @endif
            </div>

            <div class="mt-8">
                <div class="rounded-xl border border-dashed border-zinc-300 bg-white/60 px-4 py-6 text-sm text-zinc-500 dark:border-zinc-700 dark:bg-zinc-900/60" wire:loading>
                    Loading case studies...
                </div>
                <div wire:loading.remove>
                    @if ($caseStudies->count() === 0)
                        <div class="rounded-2xl border border-zinc-200 bg-white p-8 text-center text-sm text-zinc-600 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300">
                            No results match your filters. Try a different industry or clear filters.
                            <div class="mt-4">
                                <flux:button variant="outline" type="button" wire:click="clearFilters">Clear filters</flux:button>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($caseStudies as $item)
                                <article class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900" wire:key="case-flux-{{ $item['id'] }}">
                                    <img class="aspect-[3/2] w-full rounded-xl object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                                    <div class="mt-4 space-y-3">
                                        <div class="flex items-center justify-between text-xs text-zinc-500">
                                            <span>{{ $industryLabels[$item['industry']] ?? $item['industry'] }}</span>
                                            <span>{{ $item['year'] }}</span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $item['title'] }}</h3>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $item['excerpt'] }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($item['types'] as $type)
                                                <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-600 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300">
                                                    {{ $type }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <div class="pt-2">
                                            <flux:button variant="outline" href="{{ url('/works/' . $item['slug']) }}">Learn more</flux:button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <div class="mt-10">
                            {{ $caseStudies->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@elseif ($isMetronic)
    <section class="kt-container-fixed py-16 lg:py-20" id="our-works">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <h2 class="text-2xl font-semibold text-mono">Our Works</h2>
                <p class="mt-2 text-base text-secondary-foreground">A snapshot of recent launches across regulated industries.</p>
            </div>
            <a class="kt-btn kt-btn-outline" href="{{ route('web.contact') }}">Request a walkthrough</a>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($featuredWorks as $item)
                <article class="kt-card" wire:key="work-metronic-{{ $item['id'] }}">
                    <div class="kt-card-content">
                        <a class="block" href="{{ url('/works/' . $item['slug']) }}">
                            <img class="w-full rounded-lg object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                            <div class="mt-4 flex items-center justify-between text-xs text-muted-foreground">
                                <span>{{ $item['client'] }}</span>
                                <span>{{ $item['year'] }}</span>
                            </div>
                            <div class="mt-2 text-base font-semibold text-mono">{{ $item['title'] }}</div>
                            <p class="mt-2 text-sm text-secondary-foreground">{{ $item['excerpt'] }}</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($item['types'] as $type)
                                    <span class="kt-badge kt-badge-sm kt-badge-outline">{{ $type }}</span>
                                @endforeach
                            </div>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="border-t border-border bg-muted/20 py-16 lg:py-20" id="case-studies">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-semibold text-mono">Case Studies</h2>
                    <p class="mt-2 text-base text-secondary-foreground">Filter by industry, type, or keyword.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div class="min-w-[220px]">
                        <label class="sr-only" for="kt-search">Search</label>
                        <input id="kt-search" class="kt-input w-full" placeholder="Search case studies" type="search" wire:model.live.debounce.400ms="q" />
                    </div>
                    <details class="relative">
                        <summary class="kt-btn kt-btn-outline">Industries</summary>
                        <div class="absolute right-0 z-10 mt-2 w-60 rounded-lg border border-border bg-background p-4 shadow-lg">
                            <div class="space-y-2">
                                @foreach ($industryOptions as $industry)
                                    <label class="flex items-center gap-2 text-sm text-secondary-foreground">
                                        <input class="kt-checkbox kt-checkbox-sm" type="checkbox" value="{{ $industry['value'] }}" wire:model.live="industries" />
                                        <span class="kt-checkbox-label">{{ $industry['label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </details>
                    <div>
                        <label class="sr-only" for="kt-per-page">Per page</label>
                        <select id="kt-per-page" class="kt-input" wire:model.live="perPage">
                            <option value="6">6 / page</option>
                            <option value="12">12 / page</option>
                            <option value="18">18 / page</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($typeOptions as $type)
                    <button type="button" class="kt-btn kt-btn-sm {{ in_array($type['value'], $types, true) ? 'kt-btn-primary' : 'kt-btn-outline' }}" wire:click="toggleType('{{ $type['value'] }}')">
                        {{ $type['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-xs text-muted-foreground">
                <span>{{ $caseStudies->total() }} results</span>
                @if ($hasFilters)
                    <button type="button" class="text-primary hover:underline" wire:click="clearFilters">Clear filters</button>
                @endif
            </div>

            <div class="mt-8">
                <div class="rounded-lg border border-dashed border-border bg-background px-4 py-6 text-sm text-muted-foreground" wire:loading>
                    Loading case studies...
                </div>
                <div wire:loading.remove>
                    @if ($caseStudies->count() === 0)
                        <div class="kt-card">
                            <div class="kt-card-content text-center text-sm text-secondary-foreground">
                                No results match your filters. Try a different industry or clear filters.
                                <div class="mt-4">
                                    <button type="button" class="kt-btn kt-btn-outline" wire:click="clearFilters">Clear filters</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($caseStudies as $item)
                                <article class="kt-card" wire:key="case-metronic-{{ $item['id'] }}">
                                    <div class="kt-card-content">
                                        <img class="w-full rounded-lg object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                                        <div class="mt-4 flex items-center justify-between text-xs text-muted-foreground">
                                            <span>{{ $industryLabels[$item['industry']] ?? $item['industry'] }}</span>
                                            <span>{{ $item['year'] }}</span>
                                        </div>
                                        <div class="mt-2 text-base font-semibold text-mono">{{ $item['title'] }}</div>
                                        <p class="mt-2 text-sm text-secondary-foreground">{{ $item['excerpt'] }}</p>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach ($item['types'] as $type)
                                                <span class="kt-badge kt-badge-sm kt-badge-outline">{{ $type }}</span>
                                            @endforeach
                                        </div>
                                        <div class="mt-4">
                                            <a class="kt-btn kt-btn-outline" href="{{ url('/works/' . $item['slug']) }}">
                                                Learn more
                                                <i class="ki-filled ki-right text-sm"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <div class="mt-10">
                            {{ $caseStudies->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@else
    <section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8" id="our-works">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Our Works</h2>
                <p class="mt-3 text-lg text-gray-600 dark:text-gray-300">
                    A curated selection of launches across operations, finance, and public services.
                </p>
            </div>
            <a href="{{ route('web.contact') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:border-gray-400 dark:border-white/20 dark:text-gray-200">Request a walkthrough</a>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($featuredWorks as $item)
                <article class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-white/10 dark:bg-gray-900" wire:key="work-custom-{{ $item['id'] }}">
                    <a class="block" href="{{ url('/works/' . $item['slug']) }}">
                        <img class="aspect-[4/3] w-full rounded-xl object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                        <div class="mt-4 space-y-2">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $item['client'] }} - {{ $industryLabels[$item['industry']] ?? $item['industry'] }} - {{ $item['year'] }}
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item['excerpt'] }}</p>
                            <div class="flex flex-wrap gap-2 pt-1">
                                @foreach ($item['types'] as $type)
                                    <span class="rounded-full border border-gray-200 bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 dark:border-white/10 dark:bg-gray-800 dark:text-gray-300">
                                        {{ $type }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="border-t border-gray-200 bg-gray-50 py-16 dark:border-white/10 dark:bg-gray-900/60 sm:py-24" id="case-studies">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Case Studies</h2>
                    <p class="mt-3 text-lg text-gray-600 dark:text-gray-300">
                        Filter the archive to find a similar industry, product type, or outcome.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div class="min-w-[220px] flex-1">
                        <label class="sr-only" for="custom-search">Search</label>
                        <input id="custom-search" type="search" placeholder="Search case studies" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm focus:border-sky-500 focus:outline-none dark:border-white/10 dark:bg-gray-900 dark:text-gray-200" wire:model.live.debounce.400ms="q" />
                    </div>
                    <details class="relative">
                        <summary class="cursor-pointer rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm dark:border-white/10 dark:bg-gray-900 dark:text-gray-200">
                            Industries
                        </summary>
                        <div class="absolute right-0 z-10 mt-2 w-64 rounded-xl border border-gray-200 bg-white p-4 shadow-lg dark:border-white/10 dark:bg-gray-900">
                            <div class="space-y-2">
                                @foreach ($industryOptions as $industry)
                                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                                        <input class="rounded border-gray-300 text-sky-500 focus:ring-sky-500 dark:border-white/10" type="checkbox" value="{{ $industry['value'] }}" wire:model.live="industries" />
                                        <span>{{ $industry['label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </details>
                    <div>
                        <label class="sr-only" for="custom-per-page">Per page</label>
                        <select id="custom-per-page" class="rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm dark:border-white/10 dark:bg-gray-900 dark:text-gray-200" wire:model.live="perPage">
                            <option value="6">6 / page</option>
                            <option value="12">12 / page</option>
                            <option value="18">18 / page</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($typeOptions as $type)
                    <button type="button" class="rounded-full border px-3 py-1 text-xs font-semibold {{ in_array($type['value'], $types, true) ? 'border-sky-500 bg-sky-500 text-white' : 'border-gray-200 bg-white text-gray-600 dark:border-white/10 dark:bg-gray-900 dark:text-gray-300' }}" wire:click="toggleType('{{ $type['value'] }}')">
                        {{ $type['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                <span>{{ $caseStudies->total() }} results</span>
                @if ($hasFilters)
                    <button type="button" class="text-sky-600 hover:text-sky-500 dark:text-sky-400 dark:hover:text-sky-300" wire:click="clearFilters">Clear filters</button>
                @endif
            </div>

            <div class="mt-8">
                <div class="rounded-xl border border-dashed border-gray-300 bg-white/70 px-4 py-6 text-sm text-gray-500 dark:border-white/20 dark:bg-gray-900/60 dark:text-gray-400" wire:loading>
                    Loading case studies...
                </div>
                <div wire:loading.remove>
                    @if ($caseStudies->count() === 0)
                        <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center text-sm text-gray-600 shadow-sm dark:border-white/10 dark:bg-gray-900 dark:text-gray-300">
                            No results match your filters. Try a different industry or clear filters.
                            <div class="mt-4">
                                <button type="button" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 dark:border-white/20 dark:text-gray-200" wire:click="clearFilters">Clear filters</button>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($caseStudies as $item)
                                <article class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-white/10 dark:bg-gray-900" wire:key="case-custom-{{ $item['id'] }}">
                                    <img class="aspect-[3/2] w-full rounded-xl object-cover" src="{{ asset($item['cover_url']) }}" alt="{{ $item['title'] }} cover" />
                                    <div class="mt-4 space-y-3">
                                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                            <span>{{ $industryLabels[$item['industry']] ?? $item['industry'] }}</span>
                                            <span>{{ $item['year'] }}</span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item['excerpt'] }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($item['types'] as $type)
                                                <span class="rounded-full border border-gray-200 bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 dark:border-white/10 dark:bg-gray-800 dark:text-gray-300">
                                                    {{ $type }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <div class="pt-2">
                                            <a class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-500 dark:text-sky-400 dark:hover:text-sky-300" href="{{ url('/works/' . $item['slug']) }}">
                                                Learn more
                                                <span aria-hidden="true">&rarr;</span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <div class="mt-10">
                            {{ $caseStudies->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
