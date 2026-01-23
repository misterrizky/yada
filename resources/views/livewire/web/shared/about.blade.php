<?php
use App\Models\PM\Project;
use App\Models\CRM\Company;
use function Livewire\Volt\computed;

$projectCount = computed(fn() => Project::count());
$clientCount = computed(fn() => Company::whereHas('projects')->count());
$clientsPerIndustry = computed(function () {
    return Company::whereHas('projects')->distinct('industry_id')->count('industry_id');
});
?>

<div id="about" class="relative isolate" aria-labelledby="about-title">
    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                <div class="max-w-3xl">
                    <p class="text-base/7 font-semibold text-indigo-600 dark:text-indigo-400">About YE</p>
                    <h2 id="about-title"
                        class="mt-2 text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">
                        Our vision & mission
                    </h2>
                </div>

                <div class="mt-8 flex flex-col gap-x-10 gap-y-14 lg:flex-row lg:items-start">
                    <div class="lg:w-full lg:max-w-2xl lg:flex-auto">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Vision
                        </h3>
                        <p class="mt-3 text-lg/8 text-gray-600 dark:text-gray-300">
                            To become the partner of choice for transformative IT consulting and solutions in the regional landscape.
                        </p>

                        <h3 class="mt-10 text-xl font-semibold text-gray-900 dark:text-white">
                            Mission
                        </h3>
                        <ul class="mt-3 space-y-2 text-base/7 text-gray-700 dark:text-gray-300">
                            <li class="flex gap-2">
                                <span aria-hidden="true" class="mt-2 size-1.5 rounded-full bg-indigo-600 dark:bg-indigo-400"></span>
                                <span>Understanding unique client needs to deliver unmatched value.</span>
                            </li>
                            <li class="flex gap-2">
                                <span aria-hidden="true" class="mt-2 size-1.5 rounded-full bg-indigo-600 dark:bg-indigo-400"></span>
                                <span>Empowering our team to thrive in a dynamic and supportive environment.</span>
                            </li>
                            <li class="flex gap-2">
                                <span aria-hidden="true" class="mt-2 size-1.5 rounded-full bg-indigo-600 dark:bg-indigo-400"></span>
                                <span>Driving sustainable growth and maximizing value for stakeholders.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:flex lg:flex-auto lg:justify-center">
                        <dl class="w-full max-w-md space-y-7 rounded-2xl bg-gray-50 p-6 ring-1 ring-gray-900/5 dark:bg-white/5 dark:ring-white/10">
                            <div class="flex flex-col-reverse gap-y-2">
                                <dt class="text-sm/6 text-gray-600 dark:text-gray-300">
                                    Delivered across public sector, enterprise, and global clients.
                                </dt>
                                <dd class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    <span class="yex-counter" data-target="{{ $this->projectCount() }}">{{ $this->projectCount() }}</span>+
                                    <span class="text-base font-medium text-gray-600 dark:text-gray-300">projects</span>
                                </dd>
                            </div>

                            <div class="flex flex-col-reverse gap-y-2">
                                <dt class="text-sm/6 text-gray-600 dark:text-gray-300">
                                    Trusted by institutions, strategic bodies, and leading companies.
                                </dt>
                                <dd class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    <span class="yex-counter" data-target="{{ $this->clientCount() }}">{{ $this->clientCount() }}</span>+
                                    <span class="text-base font-medium text-gray-600 dark:text-gray-300">clients</span>
                                </dd>
                            </div>

                            <div class="flex flex-col-reverse gap-y-2">
                                <dt class="text-sm/6 text-gray-600 dark:text-gray-300">
                                    From defense & public services to retail, finance, and emerging tech.
                                </dt>
                                <dd class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    <span class="yex-counter" data-target="{{ $this->clientsPerIndustry }}">{{ $this->clientsPerIndustry }}</span>+
                                    <span class="text-base font-medium text-gray-600 dark:text-gray-300">industries</span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
