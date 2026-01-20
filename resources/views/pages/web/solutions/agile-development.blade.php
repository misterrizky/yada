<?php

use function Laravel\Folio\name;

name('web.solutions.agile-development');
?>
<x-layouts.web :title="__('Agile Projects at YE: Scalable, Reliable Software')" :description="__('Explore YE agile development projects delivering scalable and user-focused enterprise solutions.')" :keywords="__('agile, scrum, devops, software projects')">
    
    <div class="relative isolate">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">

                <!-- POLYGON KIRI (TEXT SIDE) -->
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true"
                    class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 fill-white dark:fill-black lg:block">
                    <polygon points="0,0 90,0 50,100 0,100" />
                </svg>

                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-56 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <h1 class="text-5xl sm:text-7xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Agile Development
                        </h1>
                        <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                            Project, Agile, Managed Services
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="relative bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 dark:bg-gray-800 overflow-hidden">

            <!-- POLYGON KANAN (IMAGE SIDE) -->
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true"
                class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 fill-white dark:fill-black lg:block">
                <polygon points="100,100 10,100 50,0 100,0" />
            </svg>

            <img src="{{ asset('assets/media/solutions/agile-dev.jpg') }}"
                alt="Agile Development" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <h2 class="text-base/7 font-semibold text-indigo-600 dark:text-indigo-400">Everything you need
                        </h2>
                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Advantage of<br>
                            Agile Development</p>
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Ensured Project Continuity
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We will help your project with a good programmer, with no risk of
                                attrition and other common human resource problem. Our company solid growth track also
                                ensures sustainability.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Best-Practice Software Engineering
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We applied our technology expertise experience with standardized quality,
                                regardless of assignee. Proven to surpass technical expectation of Western tech
                                companies. Here's an overview of our standard:
                            </dd>
                            <dd class="mt-2 grid grid-cols-2">
                                <ul class="list-disc">
                                    <li>Automated test script</li>
                                    <li>Browser compatibility check</li>
                                    <li>Repository server</li>
                                </ul>
                                <ul class="list-disc">
                                    <li>Project management tools</li>
                                    <li>Performance and scalability Security</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Technical Support
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We have a large community developers that turned into a forum to help
                                solve customer's business problem. We strive to allow tech-enabled innovation to happen.
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="relative isolate">
        <section class="py-14 lg:py-20">
            <div class="mx-auto max-w-6xl px-6 lg:px-8">
                <div class="relative flex items-center justify-center">
                    <!-- LEFT IMAGE -->
                    <div class="relative w-full max-w-[560px]">
                        <img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c0?q=80&w=1600&auto=format&fit=crop"
                            alt="Team" class="h-[560px] w-full object-cover lg:h-[660px]" />
                    </div>

                    <!-- RIGHT CARD (OVERLAP) -->
                    <div
                        class="relative -ml-16 w-full max-w-[560px] bg-white dark:bg-black px-10 py-12 shadow-[0_14px_40px_rgba(0,0,0,0.14)] lg:-ml-24 lg:mt-0">

                        <h1 class="text-[34px] font-extrabold leading-[1.15] text-black dark:text-white lg:text-[42px]">
                            Experience the
                            <br>
                            <a href="#" class="text-blue-800 underline decoration-2 underline-offset-4">
                                Agile 2-Weeks Trial
                            </a>
                            <br />
                            with YE
                        </h1>

                        <p class="mt-6 max-w-[520px] text-[13px] leading-6 text-gray-500 lg:text-[14px]">
                            Transform your Agile journey with our Two Weeks Trial. Experience
                            YE' excellence through team collaboration, work styles,
                            deliverable processes, and outcomes. See how our robust systems
                            ensure consistent, high-quality delivery.
                        </p>

                        <p class="mt-5 max-w-[520px] text-[13px] leading-6 text-gray-500 lg:text-[14px]">
                            Align our services with your company's goals and culture. Ignite
                            your transformation with YE.
                        </p>

                        <p class="mt-8 text-[15px] font-bold text-black dark:text-white">
                            Contact us today for a
                            <span class="text-blue-800">two-weeks trial!</span>
                        </p>

                        <div class="mt-7 flex flex-wrap gap-4">
                            <!-- Contact Us -->
                            <a href="{{ route('web.contact') }}" wire:navigate
                                class="inline-flex items-center gap-2 bg-blue-800 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-4 w-4">
                                    <path
                                        d="M1.5 6.75A3.75 3.75 0 015.25 3h13.5A3.75 3.75 0 0122.5 6.75v10.5A3.75 3.75 0 0118.75 21H5.25A3.75 3.75 0 011.5 17.25V6.75zm3.75-1.5a2.25 2.25 0 00-2.25 2.25v.243l8.41 5.606a1.5 1.5 0 001.68 0l8.41-5.606V6.75a2.25 2.25 0 00-2.25-2.25H5.25zm16.5 4.257l-7.57 5.047a3 3 0 01-3.36 0l-7.57-5.047v7.743A2.25 2.25 0 005.25 18.75h13.5A2.25 2.25 0 0021.75 17.25V9.507z" />
                                </svg>
                                Contact us
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/+62817321025"
                                class="inline-flex items-center gap-2 bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-4 w-4">
                                    <path
                                        d="M12.004 2.002c-5.514 0-10 4.486-10 10 0 1.766.463 3.49 1.34 5.004L2 22l5.143-1.317A9.95 9.95 0 0012.004 22c5.514 0 10-4.486 10-10s-4.486-9.998-10-9.998zm0 18.2a8.16 8.16 0 01-4.162-1.137l-.298-.176-3.056.782.815-2.98-.194-.307A8.144 8.144 0 013.8 12.002c0-4.522 3.68-8.2 8.204-8.2 4.52 0 8.2 3.678 8.2 8.2 0 4.52-3.68 8.2-8.2 8.2zm4.748-5.96c-.26-.13-1.536-.758-1.774-.845-.238-.087-.412-.13-.585.13-.173.26-.672.845-.824 1.018-.152.173-.303.195-.563.065-.26-.13-1.098-.404-2.093-1.288-.774-.69-1.297-1.54-1.45-1.8-.152-.26-.016-.4.114-.53.117-.117.26-.304.39-.456.13-.152.173-.26.26-.433.087-.173.043-.325-.022-.455-.065-.13-.585-1.41-.802-1.93-.212-.51-.427-.44-.585-.448l-.5-.01c-.173 0-.455.065-.694.325-.238.26-.91.89-.91 2.17 0 1.28.933 2.52 1.063 2.693.13.173 1.836 2.804 4.45 3.93.622.27 1.106.432 1.485.553.624.198 1.193.17 1.642.104.5-.074 1.536-.628 1.753-1.234.217-.606.217-1.126.152-1.234-.065-.108-.238-.173-.498-.303z" />
                                </svg>
                                Chat us now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- RESPONSIVE MOBILE -->
                <div class="mt-10 lg:hidden">
                    <p class="text-center text-sm text-gray-400">
                        (Tampilan mobile otomatis jadi stack ke bawah)
                    </p>
                </div>
            </div>
        </section>
    </div>
    <div class="relative section">
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-6xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-16">
                    <!-- LEFT -->
                    <div class="relative">
                        <div class="mb-10 h-[2px] w-[92%] bg-black/40"></div>
                        <h2 class="text-4xl font-extrabold leading-[1.05] text-black dark:text-white">
                            Team Members<br />
                            on Agile Project
                        </h2>

                        <p class="mt-5 max-w-md text-sm leading-6 text-gray-600">
                            Agile teams span functions and are composed of 5–11 members from across the
                            organization who are dedicated to their team full-time.
                        </p>

                        <div class="mt-10 h-[2px] w-[92%] bg-black/40"></div>
                    </div>

                    <!-- RIGHT GRID -->
                    <div class="grid grid-cols-2 gap-y-10 sm:grid-cols-3">
                        <!-- 1 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-12 w-12 text-blue-700"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46.2" cy="18" r="9" />
                                <path d="M42 18h8" />
                                <path d="M46 14v8" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Project Coordinator</p>
                        </div>

                        <!-- 2 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-12 w-12 text-blue-700"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M44 22l4-8" />
                                <path d="M44 14h8" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Engineering Manager</p>
                        </div>

                        <!-- 3 -->
                        <div class="flex flex-col items-center text-center sm:pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M43 16l-3 2 3 2" />
                                <path d="M49 16l3 2-3 2" />
                                <path d="M46 15l-2 6" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Front End Developer</p>
                        </div>

                        <!-- 4 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M44 16h6" />
                                <path d="M44 20h6" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Back End Developer</p>
                        </div>

                        <!-- 5 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <rect x="42" y="13" width="8" height="10" rx="1.5" />
                                <path d="M46 22v1" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Mobile Developer</p>
                        </div>

                        <!-- 6 -->
                        <div class="flex flex-col items-center text-center sm:pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M42 21l8-8" />
                                <path d="M42 15h4" />
                                <path d="M46 13v4" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Designer</p>
                        </div>

                        <!-- 7 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M43 18h6" />
                                <path d="M46 15v6" />
                                <path d="M44 23l2 2 2-2" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">QA Officer</p>
                        </div>

                        <!-- 8 -->
                        <div
                            class="flex flex-col items-center text-center sm:border-r sm:border-black/15 dark:sm:border-white/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="28" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="46" cy="18" r="9" />
                                <path d="M42 16h8" />
                                <path d="M43 20h6" />
                                <path d="M44 14h4" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">System Admin</p>
                        </div>

                        <!-- spacer biar baris terakhir cuma 2 -->
                        <div class="hidden sm:block"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="mx-auto max-w-[1400px] px-6 py-8">
        <!-- thin top line -->
        <div class="h-px w-full bg-slate-900/55"></div>

        <!-- title -->
        <h1 class="mt-6 text-[44px] leading-[0.95] font-black tracking-tight">
            Project, Agile and<br />
            Managed Services
        </h1>

        <!-- step bar -->
        <div class="mt-10">
            <div class="relative h-[72px] w-full">
                <!-- base bar -->
                <div class="absolute inset-0 bg-[var(--brand)]"></div>

                <!-- left label -->
                <div
                    class="bg-black dark:bg-white absolute left-0 top-0 h-full w-[38%] flex items-center justify-center">
                    <span class="text-white dark:text-black font-extrabold text-[18px]">
                        Predevelopment
                    </span>
                </div>

                <!-- right label -->
                <div
                    class="bg-black dark:bg-white absolute right-0 top-0 h-full w-[62%] flex items-center justify-center">
                    <span class="text-white dark:text-black font-extrabold text-[18px]">
                        Development
                    </span>
                </div>

                <!-- white chevron divider (two layers to mimic screenshot) -->
                <div class="absolute left-[38%] top-0 h-full -translate-x-1/2">
                    <!-- thick white chevron -->
                    <div class="h-full w-[86px] bg-white dark:bg-black"
                        style="clip-path: polygon(0 0, 55% 0, 100% 50%, 55% 100%, 0 100%, 45% 50%);"></div>

                    <!-- inner brand chevron cut (makes it look like a notch) -->
                    <div class="absolute inset-y-0 left-[10px] w-[72px] bg-[var(--brand)]"
                        style="clip-path: polygon(0 0, 55% 0, 100% 50%, 55% 100%, 0 100%, 45% 50%);"></div>
                </div>
            </div>
        </div>
    </section>
    <livewire:web.solutions.workflow-agile />
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta />
</x-layouts.web>
