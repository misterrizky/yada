<?php

use function Laravel\Folio\name;

name('web.careers');
?>
<x-layouts.web :title="__('Careers')" :description="__('')">
    <livewire:web.careers.hero>
    <!-- <main class="bg-white dark:bg-zinc-950">
        {{-- Hero Section --}}
        {{-- How to Join Us Section --}}
        <section class="border-b border-zinc-200 bg-zinc-900 py-16 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div class="gsap-fade-left">
                        <h2 class="text-3xl font-bold text-white lg:text-4xl">How to join us</h2>
                        <p class="mt-4 text-lg text-zinc-300">
                            Ready to start your career journey with us? Here's how you can join our team.
                        </p>

                        <div class="mt-8 space-y-6">
                            <div class="flex gap-4">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">1</div>
                                <div>
                                    <h3 class="font-semibold text-white">Browse Open Positions</h3>
                                    <p class="mt-1 text-sm text-zinc-400">Find the role that matches your skills and passion.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">2</div>
                                <div>
                                    <h3 class="font-semibold text-white">Submit Your Application</h3>
                                    <p class="mt-1 text-sm text-zinc-400">Send us your resume and cover letter.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">3</div>
                                <div>
                                    <h3 class="font-semibold text-white">Interview Process</h3>
                                    <p class="mt-1 text-sm text-zinc-400">Meet our team and showcase your talents.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">4</div>
                                <div>
                                    <h3 class="font-semibold text-white">Join Our Team</h3>
                                    <p class="mt-1 text-sm text-zinc-400">Start your journey with us and make an impact.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-zinc-800 bg-zinc-800/50 p-8 gsap-fade-right">
                        <img src="{{ asset('media/component-images/project-app-screenshot.png') }}" alt="Team" class="w-full rounded-lg gsap-parallax" />
                    </div>
                </div>
            </div>
        </section>

        {{-- Benefits Section --}}
        <section class="border-b border-zinc-200 bg-blue-600 py-16 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid gap-12 md:grid-cols-3">
                    <div class="text-center text-white gsap-fade-up">
                        <div class="mx-auto flex size-16 items-center justify-center rounded-full bg-white/20">
                            <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Structures</h3>
                        <p class="mt-2 text-sm text-blue-100">Well-organized teams with clear career paths and growth opportunities.</p>
                    </div>
                    <div class="text-center text-white gsap-fade-up">
                        <div class="mx-auto flex size-16 items-center justify-center rounded-full bg-white/20">
                            <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Facilities</h3>
                        <p class="mt-2 text-sm text-blue-100">Modern workspace with state-of-the-art equipment and comfortable environment.</p>
                    </div>
                    <div class="text-center text-white gsap-fade-up">
                        <div class="mx-auto flex size-16 items-center justify-center rounded-full bg-white/20">
                            <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Benefits</h3>
                        <p class="mt-2 text-sm text-blue-100">Competitive salary, health insurance, and continuous learning opportunities.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Open Positions Section --}}
        <section class="bg-white py-16 dark:bg-zinc-950 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="text-center gsap-fade-up">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white lg:text-4xl">Open Positions</h2>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                        We're always looking for talented individuals to join our team.
                    </p>
                </div>

                <div class="mt-12 space-y-6 blog-list">
                    {{-- Job Listing 1 --}}
                    <div class="group rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900 dark:hover:shadow-zinc-900/50 blog-item">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">FULL-TIME</span>
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Remote</span>
                                </div>
                                <h3 class="mt-3 text-xl font-semibold text-zinc-900 dark:text-white">Ruby On Rails Developer</h3>
                                <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    We're looking for an experienced Ruby on Rails developer to join our backend team.
                                </p>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Ruby on Rails</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">PostgreSQL</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Redis</span>
                                </div>
                            </div>
                            <flux:button variant="primary" size="sm" href="{{ route('web.contact') }}">Apply Now</flux:button>
                        </div>
                    </div>

                    {{-- Job Listing 2 --}}
                    <div class="group rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900 dark:hover:shadow-zinc-900/50 blog-item">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">FULL-TIME</span>
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Hybrid</span>
                                </div>
                                <h3 class="mt-3 text-xl font-semibold text-zinc-900 dark:text-white">Frontend Developer</h3>
                                <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Join our frontend team to build beautiful and performant user interfaces.
                                </p>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">React</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">TypeScript</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Tailwind CSS</span>
                                </div>
                            </div>
                            <flux:button variant="primary" size="sm" href="{{ route('web.contact') }}">Apply Now</flux:button>
                        </div>
                    </div>

                    {{-- Job Listing 3 --}}
                    <div class="group rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900 dark:hover:shadow-zinc-900/50 blog-item">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">PART-TIME</span>
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Remote</span>
                                </div>
                                <h3 class="mt-3 text-xl font-semibold text-zinc-900 dark:text-white">UI/UX Designer</h3>
                                <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Help us create exceptional user experiences for our products.
                                </p>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Figma</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Adobe XD</span>
                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">Prototyping</span>
                                </div>
                            </div>
                            <flux:button variant="primary" size="sm" href="{{ route('web.contact') }}">Apply Now</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="border-t border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900/40 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="text-center gsap-fade-up">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white lg:text-4xl">What can we do to help you?</h2>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                        Have questions about careers at {{ config('app.name') }}? We're here to help.
                    </p>
                    <div class="mt-8">
                        <flux:button variant="primary" size="sm" href="{{ route('web.contact') }}">Contact Us</flux:button>
                    </div>
                </div>
            </div>
        </section>
    </main> -->

    @push('scripts')
    <script>
        // Animated Counter Function (reuse from home page)
        function animateCounter(element, target, duration = 2000) {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    const hasPlus = element.dataset.suffix === '+';
                    const hasPercent = element.dataset.suffix === '%';
                    element.textContent = Math.floor(current) + (hasPlus ? '+' : hasPercent ? '%' : '');
                }
            }, 16);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const counterElements = document.querySelectorAll('[data-counter]');

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.dataset.animated) {
                        const target = parseInt(entry.target.dataset.counter);
                        entry.target.dataset.animated = 'true';
                        animateCounter(entry.target, target);
                    }
                });
            }, observerOptions);

            counterElements.forEach(el => observer.observe(el));
        });
    </script>
    @endpush
</x-layouts.web>
