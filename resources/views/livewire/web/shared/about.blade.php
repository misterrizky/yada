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
<div class="relative isolate">
    <div class="py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                    Our vision</h2>
                <div class="mt-6 flex flex-col gap-x-8 gap-y-20 lg:flex-row">
                    <div class="lg:w-full lg:max-w-2xl lg:flex-auto">
                        <p class="text-xl/8 text-gray-600 dark:text-gray-300">To become the partner of choice for
                            transformative IT
                            consulting and solutions in the regional landscape.</p>
                        <h2
                            class=" mt-10 mb-5 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Our mission</h2>
                        <ul>
                            <li class=" max-w-xl text-base/7 text-gray-700 dark:text-gray-400"> - Understanding unique
                                client needs to deliver unmatched value.
                            </li>
                            <li class=" max-w-xl text-base/7 text-gray-700 dark:text-gray-400"> - Empowering our team to
                                thrive in a dynamic and supportive environment.
                            </li>
                            <li class=" max-w-xl text-base/7 text-gray-700 dark:text-gray-400"> - Driving sustainable
                                growth and maximizing value for stakeholders.
                                </p>
                    </div>
                    <div class="lg:flex lg:flex-auto lg:justify-center">
                        <dl class="w-64 space-y-8 xl:w-80">
                            <div class="flex flex-col-reverse gap-y-4">
                                <dt class="text-base/7 text-gray-600 dark:text-gray-400">Delivered across public sector,
                                    enterprise, and global clients.
                                </dt>
                                <dd class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white"><span
                                        data-target="38">{{ $this->projectCount() }}</span>+ Project</dd>
                            </div>
                            <div class="flex flex-col-reverse gap-y-4">
                                <dt class="text-base/7 text-gray-600 dark:text-gray-400">Trusted by government
                                    institutions, strategic bodies, and leading companies.</dt>
                                <dd class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white"><span
                                        data-target="26">{{ $this->clientCount() }}</span>+ Client</dd>
                            </div>
                            <div class="flex flex-col-reverse gap-y-4">
                                <dt class="text-base/7 text-gray-600 dark:text-gray-400">From defense & public services
                                    to retail, finance, and emerging tech.</dt>
                                <dd class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white"><span
                                        data-target="109">{{ $this->clientsPerIndustry }}+</span> Industries
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        function initCounters() {
            // Ensure GSAP is loaded
            if (typeof gsap === 'undefined') {
                console.warn('GSAP not loaded, counter animation skipped');
                // Fallback: show final values
                document.querySelectorAll('.counter').forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    counter.textContent = target;
                });
                return;
            }

            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const obj = { value: 0 };

                gsap.to(obj, {
                    value: target,
                    duration: 2,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: counter,
                        start: 'top 80%',
                        once: true
                    },
                    onUpdate: function () {
                        counter.textContent = Math.round(obj.value);
                    }
                });
            });
        }

        // Initialize on load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCounters);
        } else {
            initCounters();
        }

        // Re-initialize on Livewire navigation
        document.addEventListener('livewire:navigated', () => {
            setTimeout(initCounters, 100);
        });
    })();
</script>