<?php

use function Laravel\Folio\name;
use Livewire\Volt\Component;

name('app.dashboard');

new class extends Component
{
    public array $companyActivityData = [];
    public array $closingDealsData = [];

    public function mount(): void
    {
        // Demo data 7 hari terakhir
        $this->companyActivityData = [
            ['date' => '2026-01-20', 'visitors' => 120],
            ['date' => '2026-01-21', 'visitors' => 155],
            ['date' => '2026-01-22', 'visitors' => 132],
            ['date' => '2026-01-23', 'visitors' => 190],
            ['date' => '2026-01-24', 'visitors' => 170],
            ['date' => '2026-01-25', 'visitors' => 210],
            ['date' => '2026-01-26', 'visitors' => 195],
        ];

        // Demo data lain untuk card kedua
        $this->closingDealsData = [
            ['date' => '2026-01-20', 'visitors' => 3],
            ['date' => '2026-01-21', 'visitors' => 5],
            ['date' => '2026-01-22', 'visitors' => 2],
            ['date' => '2026-01-23', 'visitors' => 6],
            ['date' => '2026-01-24', 'visitors' => 4],
            ['date' => '2026-01-25', 'visitors' => 7],
            ['date' => '2026-01-26', 'visitors' => 5],
        ];
    }
};
?>
<x-layouts.app :title="__('Insights')">
    @volt
    <flux:main>
        <flux:breadcrumbs class="mb-5">
            <flux:breadcrumbs.item>Dashboard</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:heading size="xl" level="1">Hello, {{ auth()->user()->name }}</flux:heading>
        <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>

        <flux:separator variant="subtle" class="mb-6" />

        <!-- ✅ Cards sejajar -->
        <div class="grid gap-6 lg:grid-cols-2 items-start">
            <!-- CARD 1 -->
            <flux:card>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <flux:heading class="m-0">Company Activities</flux:heading>

                        <flux:tooltip toggleable>
                            <flux:button icon="information-circle" size="sm" variant="ghost" />
                            <flux:tooltip.content class="max-w-[20rem] space-y-2">
                                <p>This card reflects the activities that you are added as owner</p>
                            </flux:tooltip.content>
                        </flux:tooltip>

                        <flux:button icon="arrow-path" size="sm" variant="ghost" />
                    </div>

                    <flux:button class="shrink-0" icon="plus" size="sm">Create Activity</flux:button>
                </div>

                <div class="mt-6">
                    <flux:chart :value="$companyActivityData" class="aspect-3/1">
                        <flux:chart.svg>
                            <flux:chart.line field="visitors" class="text-pink-500 dark:text-pink-400" />

                            <flux:chart.axis axis="x" field="date">
                                <flux:chart.axis.line />
                                <flux:chart.axis.tick />
                            </flux:chart.axis>

                            <flux:chart.axis axis="y">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                            </flux:chart.axis>

                            <flux:chart.cursor />
                        </flux:chart.svg>

                        <flux:chart.tooltip>
                            <flux:chart.tooltip.heading
                                field="date"
                                :format="['year' => 'numeric', 'month' => 'numeric', 'day' => 'numeric']"
                            />
                            <flux:chart.tooltip.value field="visitors" label="Visitors" />
                        </flux:chart.tooltip>
                    </flux:chart>
                </div>
            </flux:card>

            <!-- CARD 2 -->
            <flux:card>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <flux:heading class="m-0">Closing Deals</flux:heading>

                        <flux:tooltip toggleable>
                            <flux:button icon="information-circle" size="sm" variant="ghost" />
                            <flux:tooltip.content class="max-w-[20rem] space-y-2">
                                <p>
                                    View the deals that are predicted to be closed based on the selected period and the expected close date,
                                    the deals marked as "Won" or "Lost" are excluded from the list
                                </p>
                            </flux:tooltip.content>
                        </flux:tooltip>

                        <flux:button icon="arrow-path" size="sm" variant="ghost" />
                    </div>

                    <!-- dropdowns rapi sejajar -->
                    <div class="flex items-center gap-2">
                        <flux:dropdown>
                            <flux:button size="sm" icon:trailing="chevron-down">All</flux:button>
                            <flux:menu>
                                <flux:menu.radio.group wire:model="owner">
                                    <flux:menu.radio>Fazli</flux:menu.radio>
                                    <flux:menu.radio>Ryandra Gunawan</flux:menu.radio>
                                    <flux:menu.radio>Rizky Ramadhan</flux:menu.radio>
                                    <flux:menu.radio checked>All</flux:menu.radio>
                                </flux:menu.radio.group>
                            </flux:menu>
                        </flux:dropdown>

                        <flux:dropdown>
                            <flux:button size="sm" icon:trailing="chevron-down">This Week</flux:button>
                            <flux:menu>
                                <flux:menu.radio.group wire:model="date">
                                    <flux:menu.radio checked>This Week</flux:menu.radio>
                                    <flux:menu.radio>This Month</flux:menu.radio>
                                    <flux:menu.radio>Next Week</flux:menu.radio>
                                    <flux:menu.radio>Next Month</flux:menu.radio>
                                </flux:menu.radio.group>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>

                <div class="mt-6">
                    <flux:chart :value="$closingDealsData" class="aspect-3/1">
                        <flux:chart.svg>
                            <flux:chart.line field="visitors" class="text-pink-500 dark:text-pink-400" />

                            <flux:chart.axis axis="x" field="date">
                                <flux:chart.axis.line />
                                <flux:chart.axis.tick />
                            </flux:chart.axis>

                            <flux:chart.axis axis="y">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                            </flux:chart.axis>

                            <flux:chart.cursor />
                        </flux:chart.svg>

                        <flux:chart.tooltip>
                            <flux:chart.tooltip.heading
                                field="date"
                                :format="['year' => 'numeric', 'month' => 'numeric', 'day' => 'numeric']"
                            />
                            <flux:chart.tooltip.value field="visitors" label="Deals" />
                        </flux:chart.tooltip>
                    </flux:chart>
                </div>
            </flux:card>
        </div>
    </flux:main>
    @endvolt
</x-layouts.app>