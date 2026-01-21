<?php

use function Laravel\Folio\name;

name('web.solutions.quality-assurance');
?>
<x-layouts.web :title="__('QA Testing Services: Ensure Performance &amp; Reliability')" :description="__('Ensure app reliability with QA automation, performance testing, and manual quality assessments from YE.')" :keywords="__('qa, testing, performance, automation, quality assurance')">
    
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
                            Quality Assurance
                        </h1>
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

            <img src="{{ asset('assets/media/services-detail/quality.png') }}"
                alt="Quality Assurance" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <hr class="border-gray-700">
                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Advantage of<br>
                            Quality Assurance</p>
                        <ul>
                            <li class="text-lg font-semibold text-blue-600 py-5">YE Standard Validation</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">Traceability Matrix</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">Capable Tester</li>
                        </ul>
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Best-Practice Testing Methods and Techniques
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We applied our expertise experience with standardized quality. Here’s an
                                overview of our standard:
                            </dd>
                            <dd class="mt-3">
                                <ul>
                                    <li class="list-disc">YE Standard Validation</li>
                                    <li class="list-disc">Traceability Matrix</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Capable Tester
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">We provide dedicated and experienced tester in developing
                                        application or website</li>
                                    <li class="list-disc">Our tester give you idea or suggestions that improve your
                                        quality software</li>
                                    <li class="list-disc">Beside following the YE standard, our tester also think
                                        outside of the box to found the bug</li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <hr class="border-gray-700">
                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Pre-requisites
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Client signature on SPK / Agreement</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Short brief about the project / apps that consists of the
                                        description of the project, purpose of the project, target user, and integration
                                        to internal system (if any)</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Client will need to assign one PIC as communication channel to
                                        Client’s teams</li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="relative isolate">
        <section class="dark:bg-black bg-white py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-14 lg:grid-cols-[520px_1fr] lg:items-start">
                    <!-- LEFT -->
                    <div>
                        <div class="h-[2px] w-full max-w-[460px] bg-black/35"></div>

                        <h2 class="mt-10 text-6xl font-extrabold leading-[1.05] text-black dark:text-white">
                            Deliverables
                        </h2>
                    </div>

                    <!-- RIGHT -->
                    <div class="max-w-[760px]">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-5 pb-10">
                            <div class="mt-1 text-blue-700">
                                <!-- Report icon -->
                                <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M18 10h24l8 8v36H18V10Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M42 10v12h12" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M26 30h14" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    <path d="M26 38h20" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    <path d="M40 44l10-10 3 3-10 10-4 1 1-4Z" stroke="currentColor" stroke-width="3"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-base font-extrabold text-black dark:text-white">
                                    Report
                                </h3>
                                <p class="mt-4 max-w-xl text-sm leading-7 text-black/55 dark:text-white/55">
                                    We will send a Daily or Weekly Report. Report is a great way to monitor
                                    our performance and ensure that projects stay on track.
                                </p>
                            </div>
                        </div>

                        <div class="h-px w-full bg-black/15"></div>

                        <!-- Item 2 -->
                        <div class="flex items-start gap-5 py-10">
                            <div class="mt-1 text-blue-700">
                                <!-- Traceability icon -->
                                <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M18 14h24v28H18V14Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M24 22l3 3 6-7" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M24 34l3 3 6-7" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="48" cy="40" r="8" stroke="currentColor"
                                        stroke-width="3" />
                                    <path d="M53 45l7 7" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-base font-extrabold text-black dark:text-white">
                                    Traceability Matrix
                                </h3>
                                <p class="mt-4 max-w-xl text-sm leading-7 text-black/55 dark:text-white/55">
                                    Traceability Matrix (TM) is a table to track and verify the
                                    fulfilment of requirements
                                </p>
                            </div>
                        </div>

                        <div class="h-px w-full bg-black/15"></div>

                        <!-- Item 3 -->
                        <div class="flex items-start gap-5 pt-10">
                            <div class="mt-1 text-blue-700">
                                <!-- Release Notes icon -->
                                <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M18 10h28v44H18V10Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M24 22h16" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M24 30h12" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M24 38h18" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-base font-extrabold text-black dark:text-white">
                                    Release Notes
                                </h3>
                                <p class="mt-4 max-w-xl text-sm leading-7 text-black/55 dark:text-white/55">
                                    Test summary in the end of sprint used as a reference for tasks that
                                    have passed the test by QA
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /RIGHT -->
                </div>
            </div>
        </section>
    </div>
    <div class="relative isolate">
        <section class="py-14">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <!-- TITLE -->
                <div class="max-w-3xl">
                    <div class="h-[2px] w-full bg-black/50 dark:bg-white/50"></div>
                    <h2 class="mt-5 text-5xl font-extrabold leading-[1.05] text-black dark:text-white">
                        Workflow for <br />
                        Quality Assurance
                    </h2>
                </div>

                <!-- FLOW -->
                <div class="mt-14">
                    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-6 lg:gap-0">
                        <!-- ===== STEP 1 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <!-- circle -->
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: learn/book -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <path d="M4 19.5V6a2 2 0 0 1 2-2h1" />
                                            <path d="M20 19.5V6a2 2 0 0 0-2-2h-1" />
                                            <path d="M7 4h10v16H7z" />
                                            <path d="M9 8h6" />
                                            <path d="M9 12h6" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- arrow -->
                                <div class="absolute left-[120px] top-1/2 hidden -translate-y-1/2 lg:block">
                                    <div class="h-[6px] w-[70px] bg-[#0A2EFF]"></div>
                                    <div
                                        class="absolute -right-[10px] top-1/2 -translate-y-1/2 h-0 w-0 border-l-[16px] border-y-transparent border-l-[#0A2EFF]">
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Learn about the <br />
                                project
                            </p>
                            <p class="mt-6 text-sm text-gray-700">
                                (Flow and Documentation)
                            </p>
                        </div>

                        <!-- ===== STEP 2 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: gear -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            <path
                                                d="M19.4 15a7.8 7.8 0 0 0 .1-1l2-1.1-2-3.4-2.3.5a7.4 7.4 0 0 0-.8-.5l-.3-2.3h-4l-.3 2.3-.8.5-2.3-.5-2 3.4 2 1.1a7.8 7.8 0 0 0 .1 1l-2 1.1 2 3.4 2.3-.5c.3.2.5.4.8.5l.3 2.3h4l.3-2.3c.3-.1.5-.3.8-.5l2.3.5 2-3.4-2-1.1z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="absolute left-[120px] top-1/2 hidden -translate-y-1/2 lg:block">
                                    <div class="h-[6px] w-[70px] bg-[#0A2EFF]"></div>
                                    <div
                                        class="absolute -right-[10px] top-1/2 -translate-y-1/2 h-0 w-0 border-y-[12px] border-l-[16px] border-y-transparent border-l-[#0A2EFF]">
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Set up and <br />
                                coordination
                            </p>
                            <p class="mt-6 text-sm text-gray-700">
                                (Communication and project management tool)
                            </p>
                        </div>

                        <!-- ===== STEP 3 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: laptop -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <rect x="3" y="4" width="18" height="12" rx="2" />
                                            <path d="M2 20h20" />
                                            <path d="M8 10l2 2 4-4" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="absolute left-[120px] top-1/2 hidden -translate-y-1/2 lg:block">
                                    <div class="h-[6px] w-[70px] bg-[#0A2EFF]"></div>
                                    <div
                                        class="absolute -right-[10px] top-1/2 -translate-y-1/2 h-0 w-0 border-y-[12px] border-l-[16px] border-y-transparent border-l-[#0A2EFF]">
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Prepare and <br />
                                installation
                            </p>
                            <p class="mt-6 text-sm text-gray-700">
                                (Report Template, Test Case, Tracebility Matrix,<br />
                                Automation Testing Tools)
                            </p>
                        </div>

                        <!-- ===== STEP 4 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: clipboard -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <rect x="9" y="2" width="6" height="4" rx="1" />
                                            <path
                                                d="M9 4H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2" />
                                            <path d="M8 11h8" />
                                            <path d="M8 15h6" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="absolute left-[120px] top-1/2 hidden -translate-y-1/2 lg:block">
                                    <div class="h-[6px] w-[70px] bg-[#0A2EFF]"></div>
                                    <div
                                        class="absolute -right-[10px] top-1/2 -translate-y-1/2 h-0 w-0 border-y-[12px] border-l-[16px] border-y-transparent border-l-[#0A2EFF]">
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Testing based on <br />
                                ticket
                            </p>
                            <p class="mt-6 text-sm text-gray-700">
                                (Whitebox, Greybox,<br />
                                Blackbox Test, QC Level 1-3)
                            </p>
                        </div>

                        <!-- ===== STEP 5 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: chat + pencil -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                                            <path d="M14 8l-5 5v3h3l5-5z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="absolute left-[120px] top-1/2 hidden -translate-y-1/2 lg:block">
                                    <div class="h-[6px] w-[70px] bg-[#0A2EFF]"></div>
                                    <div
                                        class="absolute -right-[10px] top-1/2 -translate-y-1/2 h-0 w-0 border-y-[12px] border-l-[16px] border-y-transparent border-l-[#0A2EFF]">
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Feedback and <br />
                                Suggestion
                            </p>
                            <p class="mt-6 text-sm text-gray-700">
                                &nbsp;
                            </p>
                        </div>

                        <!-- ===== STEP 6 ===== -->
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative">
                                <div
                                    class="flex h-[120px] w-[120px] items-center justify-center rounded-full bg-[#E9EEFF]">
                                    <div
                                        class="flex h-[94px] w-[94px] items-center justify-center rounded-full bg-[#0A2EFF]">
                                        <!-- icon: document + pencil -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-10 w-10">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                            <path d="M9 15l6-6 2 2-6 6H9z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-5 text-base font-extrabold text-black dark:text-white leading-snug">
                                Reporting
                            </p>
                            <p class="mt-6 text-sm text-gray-700">&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta />
</x-layouts.web>
