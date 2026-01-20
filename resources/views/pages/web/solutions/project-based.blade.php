<?php

use function Laravel\Folio\name;

name('web.solutions.project-based');
?>
<x-layouts.web :title="__('Project-Based Software Solutions by YE')" :description="__('Get flexible project-based software services tailored to your enterprise goals, budget, and timeline.')" :keywords="__('project-based, software development, agile, scrum, devops, software projects, custom dev')">
    
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
                            Project Based
                        </h1>
                        <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Development</h1>
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

            <img src="{{ asset('assets/media/solutions/project-based.jpg') }}"
                alt="Agile Development" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">

                    <div>
                        <hr class="my-2 border-gray-700">
                        <h2 class="text-base/7 font-semibold text-indigo-600 dark:text-indigo-400">
                            Comprehensive delivery for your digital initiatives
                        </h2>

                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Advantages of<br>
                            Project-Based Engagement
                        </p>

                        <ul>
                            <li class="text-lg font-semibold text-blue-600 py-5">CUSTOMIZED APPLICATION DEVELOPMENT</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">FIXED SCOPE, BUDGET & DELIVERY TIMELINE
                            </li>
                            <li class="text-lg font-semibold text-blue-600 py-5">DEDICATED CROSS-FUNCTIONAL TEAM</li>
                        </ul>
                    </div>

                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">

                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Ensured Project Continuity
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">
                                We ensure stable project execution through structured delivery and reliable resource
                                allocation. Our
                                engagement model minimizes the risk of attrition and common staffing challenges,
                                enabling consistent
                                progress throughout the project lifecycle.
                            </dd>
                        </div>

                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Standardized Software Engineering Practices
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">
                                Our teams adhere to established engineering standards to maintain consistent quality
                                across delivery.
                                Supported by proven processes, documentation, and quality assurance, we deliver
                                solutions aligned with
                                international best practices. The following are included as part of our standard
                                approach:
                                <div class="flex text-sm py-2 pt-4">
                                    <ul class="w-full">
                                        <li class="list-disc">Automated testing procedures</li>
                                        <li class="list-disc">Cross-browser compatibility validation</li>
                                        <li class="list-disc">Centralized repository management</li>
                                    </ul>
                                    <ul class="w-full">
                                        <li class="list-disc">Code review and quality assurance</li>
                                        <li class="list-disc">Structured documentation process</li>
                                        <li class="list-disc">Secure deployment workflow</li>
                                    </ul>
                                </div>
                            </dd>
                        </div>

                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Ongoing Technical Support
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">
                                We provide continuous technical assistance to ensure long-term system reliability.
                                Backed by an extensive
                                developer community and internal expertise, we support maintenance, issue resolution,
                                and future
                                enhancements to help sustain business growth.
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2
                        class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                        Project Categories</h2>
                </div>
                <dl
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">FCMG</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Unilever</li>
                                <li>P&G</li>
                            </ul>
                            <ul>
                                <li>Unilever</li>
                                <li>Orang Tua</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">FINANCIAL SERVICES</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>BCA</li>
                                <li>Mandiri</li>
                                <li>OCBC NISP</li>
                            </ul>
                            <ul>
                                <li>CIMB Niaga</li>
                                <li>BRI</li>
                                <li>BTPN</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">AUTOMOTIVE</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-1 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Astra International</li>
                                <li>United Tractors</li>
                                <li>Komatsu</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">TECHNOLOGY</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Kakaotalk</li>
                                <li>Gojek</li>
                            </ul>
                            <ul>
                                <li>Berrybenka</li>
                                <li>OLX</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">FINTECH</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Bank Jago</li>
                                <li>Kredit Pintar</li>
                            </ul>
                            <ul>
                                <li>Amartha</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">TRANSPORTATION</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-1 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>PT Kereta Api Indonesia</li>
                                <li>Blue Bird Group</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">ENERGY AND MINING</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Holcim</li>
                            </ul>
                            <ul>
                                <li>Enulsa</li>
                            </ul>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">TELCO</dt>
                        <hr class="my-2 border-gray-700">
                        <dd
                            class="mt-1 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2 text-gray-600 dark:text-gray-400">
                            <ul>
                                <li>Telkomsel</li>
                            </ul>
                            <ul>
                                <li>SingTel</li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div> --}}
    <div class="relative isolate">
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-6xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-16">
                    <!-- LEFT -->
                    <div class="relative">
                        <!-- top line -->
                        <div class="mb-7 h-[2px] w-[78%] dark:bg-white/40 bg-black/40"></div>

                        <h2 class="text-4xl font-extrabold leading-[1.05] dark:text-white text-black">
                            Team Members<br />
                            on Agile Project
                        </h2>

                        <p class="mt-5 max-w-md text-sm leading-6 text-gray-600">
                            Agile teams span functions and are composed of 5–11 members from across the
                            organization who are dedicated to their team full-time.
                        </p>

                        <!-- bottom line -->
                        <div class="mt-10 h-[2px] w-[92%] bg-black/40"></div>
                    </div>

                    <!-- RIGHT GRID -->
                    <div class="grid grid-cols-2 gap-y-10 sm:grid-cols-3">
                        <!-- 1 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-12 w-12 text-blue-700"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
                                <path d="M42 18h8" />
                                <path d="M46 14v8" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Project Coordinator</p>
                        </div>

                        <!-- 2 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
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
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
                                <path d="M43 16l-3 2 3 2" />
                                <path d="M49 16l3 2-3 2" />
                                <path d="M46 15l-2 6" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Front End Developer</p>
                        </div>

                        <!-- 4 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
                                <path d="M44 16h6" />
                                <path d="M44 20h6" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Back End Developer</p>
                        </div>

                        <!-- 5 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
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
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
                                <path d="M42 21l8-8" />
                                <path d="M42 15h4" />
                                <path d="M46 13v4" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">Designer</p>
                        </div>

                        <!-- 7 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:pr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
                                <path d="M43 18h6" />
                                <path d="M46 15v6" />
                                <path d="M44 23l2 2 2-2" />
                            </svg>
                            <p class="mt-2 text-xs font-semibold text-gray-700">QA Officer</p>
                        </div>

                        <!-- 8 -->
                        <div class="flex flex-col items-center text-center sm:border-r sm:border-black/15 sm:px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                class="h-12 w-12 text-blue-700" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="27" cy="22" r="7" />
                                <path d="M8 50c2-10 10-16 20-16s18 6 20 16" />
                                <circle cx="47" cy="18" r="9" />
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
    <div class="relative isolate ">
        <section class="py-10">
            <div class="mx-auto max-w-6xl px-6 lg:px-8">
                <!-- Title -->
                <h2 class="text-xl font-extrabold leading-tight dark:text-white text-black">
                    Workflow for <br />
                    Project Based
                </h2>

                <!-- Main Card -->
                <div class="mt-4 overflow-hidden rounded-sm dark:bg-black bg-white shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-[90px_1fr]">
                        <!-- LEFT STEPS BAR -->
                        <div class="relative bg-[#0A2EFF]">
                            <!-- Step blocks -->
                            <div class="flex h-full flex-col">
                                <!-- Step 1 -->
                                <div class="relative flex h-[130px] items-center justify-center">
                                    <div class="rotate-[-90deg] text-xs font-semibold tracking-wide text-white">
                                        Requirements
                                    </div>

                                    <!-- chevron down -->
                                    <div
                                        class="absolute -bottom-6 left-0 right-0 mx-auto h-0 w-0 border-l-[45px] border-r-[45px] border-t-[24px] border-l-transparent border-r-transparent border-t-[#0A2EFF]">
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="relative flex h-[130px] items-center justify-center bg-[#0A2EFF]">
                                    <div class="rotate-[-90deg] text-xs font-semibold tracking-wide text-white">
                                        Documentation
                                    </div>

                                    <div
                                        class="absolute -bottom-6 left-0 right-0 mx-auto h-0 w-0 border-l-[45px] border-r-[45px] border-t-[24px] border-l-transparent border-r-transparent border-t-[#0A2EFF]">
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="relative flex h-[130px] items-center justify-center bg-[#0A2EFF]">
                                    <div class="rotate-[-90deg] text-xs font-semibold tracking-wide text-white">
                                        Development
                                    </div>

                                    <div
                                        class="absolute -bottom-6 left-0 right-0 mx-auto h-0 w-0 border-l-[45px] border-r-[45px] border-t-[24px] border-l-transparent border-r-transparent border-t-[#0A2EFF]">
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="relative flex h-[130px] items-center justify-center bg-[#13B4E7]">
                                    <div class="rotate-[-90deg] text-xs font-semibold tracking-wide text-white">
                                        UAT
                                    </div>

                                    <div
                                        class="absolute -bottom-6 left-0 right-0 mx-auto h-0 w-0 border-l-[45px] border-r-[45px] border-t-[24px] border-l-transparent border-r-transparent border-t-[#13B4E7]">
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex h-[130px] items-center justify-center bg-[#0A2EFF]">
                                    <div class="rotate-[-90deg] text-xs font-semibold tracking-wide text-white">
                                        Live
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT CONTENT -->
                        <div class="divide-y divide-black/10">
                            <!-- ROW 1 -->
                            <div class="grid grid-cols-1 gap-8 px-8 py-7 lg:grid-cols-2">
                                <div class="text-xs leading-5 text-gray-600">
                                    <p>
                                        Our first action is to help you in building applications and
                                        prepare the best solution for your business goals starting
                                        by understanding the goals through continuous discussion
                                        with your stakeholders gathering related documents.
                                    </p>
                                </div>

                                <div class="text-xs leading-5 text-gray-700">
                                    <p class="font-semibold dark:text-white text-black">Document Provided</p>
                                    <ul class="mt-2 space-y-1">
                                        <li>• Business Requirement (CR)</li>
                                        <li>• Mockup</li>
                                        <li>• Official Quotation</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- ROW 2 -->
                            <div class="grid grid-cols-1 gap-8 px-8 py-7 lg:grid-cols-2">
                                <div class="text-xs leading-5 text-gray-600">
                                    <p>
                                        To build mutual understanding of the application that will
                                        be developed, we will propose an SRS document or system
                                        blueprint for the app. This document will show detailed
                                        information regarding application features based on BRD.
                                    </p>
                                </div>

                                <div class="text-xs leading-5 text-gray-700">
                                    <p class="font-semibold dark:text-white text-black">Document Provided</p>
                                    <ul class="mt-2 space-y-1">
                                        <li>• SRS</li>
                                        <li>• Timeline</li>
                                        <li>• Task-plan / Use Case</li>
                                        <li>• Technical Documentation</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- ROW 3 (Agile diagram) -->
                            <div class="grid grid-cols-1 gap-8 px-8 py-7 lg:grid-cols-2">
                                <div>
                                    <p class="text-xs font-semibold dark:text-white text-black">Agile Sprint</p>

                                    <!-- ✅ wrapper kecil -->
                                    <div
                                        class="mt-4 inline-flex rounded-md border border-black/10 dark:border-white/10 bg-white dark:bg-black px-4 py-3">
                                        <svg viewBox="0 0 900 320" class="h-[130px] w-auto"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <!-- defs -->
                                            <defs>
                                                <marker id="arrow" viewBox="0 0 20 10" refX="10"
                                                    refY="5" markerWidth="7" markerHeight="7" orient="auto">
                                                    <path d="M 0 0 L 10 5 L 0 10 z" fill="#0B33FF" />
                                                </marker>

                                                <filter id="glow" x="-40%" y="-40%" width="180%"
                                                    height="180%">
                                                    <feGaussianBlur stdDeviation="4" result="blur" />
                                                    <feMerge>
                                                        <feMergeNode in="blur" />
                                                        <feMergeNode in="SourceGraphic" />
                                                    </feMerge>
                                                </filter>
                                            </defs>

                                            <rect x="90" y="0" width="900" height="320" fill="transparent" />

                                            <!-- TOP FLOW -->
                                            <path d="M 130 110 H 700" stroke="#0B33FF" stroke-width="10"
                                                stroke-linecap="round" fill="none" marker-end="url(#arrow)" />

                                            <!-- BOTTOM FLOW -->
                                            <path d="M 700 210 H 170" stroke="#0B33FF" stroke-width="10"
                                                stroke-linecap="round" fill="none" marker-end="url(#arrow)" />

                                            <!-- RIGHT LOOP -->
                                            <path d="M 700 110 C 820 110, 820 210, 700 210" stroke="#0B33FF"
                                                stroke-width="10" stroke-linecap="round" fill="none" />

                                            <!-- LEFT CONNECT -->
                                            <path d="M 130 110 C 60 110, 60 210, 170 210" stroke="#0B33FF"
                                                stroke-width="10" stroke-linecap="round" fill="none" />

                                            <!-- LABELS TOP -->
                                            <text x="150" y="55" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Scope
                                            </text>
                                            <text x="405" y="55" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Propose
                                            </text>
                                            <text x="585" y="55" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Develop
                                            </text>

                                            <!-- LABELS MID -->
                                            <text x="265" y="158" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Estimate
                                            </text>

                                            <!-- LABELS BOTTOM -->
                                            <text x="150" y="290" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Measure
                                            </text>
                                            <text x="325" y="290" fill="#6B7280" font-size="26" font-weight="700">
                                                UAT
                                            </text>
                                            <text x="465" y="290" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Deploy
                                            </text>
                                            <text x="650" y="290" fill="#A0A3AA" font-size="26" font-weight="600">
                                                Demo
                                            </text>

                                            <!-- STEPS TOP -->
                                            <g filter="url(#glow)">
                                                <circle cx="170" cy="110" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="170" cy="110" r="18" fill="#0B33FF" />
                                                <text x="170" y="117" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    1
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="310" cy="110" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="310" cy="110" r="18" fill="#0B33FF" />
                                                <text x="310" y="117" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    2
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="450" cy="110" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="450" cy="110" r="18" fill="#0B33FF" />
                                                <text x="450" y="117" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    3
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="590" cy="110" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="590" cy="110" r="18" fill="#0B33FF" />
                                                <text x="590" y="117" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    4
                                                </text>
                                            </g>

                                            <!-- STEPS BOTTOM -->
                                            <g filter="url(#glow)">
                                                <circle cx="690" cy="210" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="690" cy="210" r="18" fill="#0B33FF" />
                                                <text x="690" y="217" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    5
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="520" cy="210" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="520" cy="210" r="18" fill="#0B33FF" />
                                                <text x="520" y="217" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    6
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="380" cy="210" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="380" cy="210" r="18" fill="#0B33FF" />
                                                <text x="380" y="217" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    7
                                                </text>
                                            </g>

                                            <g filter="url(#glow)">
                                                <circle cx="220" cy="210" r="26" fill="#CBD5FF"
                                                    opacity="0.9" />
                                                <circle cx="220" cy="210" r="18" fill="#0B33FF" />
                                                <text x="220" y="217" text-anchor="middle" fill="white"
                                                    font-size="18" font-weight="800">
                                                    8
                                                </text>
                                            </g>
                                        </svg>
                                    </div>
                                </div>

                                <div class="text-xs leading-5 text-gray-700">
                                    <p class="font-semibold dark:text-white text-black">Methodology</p>
                                    <p class="mt-2 text-gray-600">
                                        Within a development phase, we are working with our most matured
                                        <span class="font-semibold">Agile methodology</span>.
                                    </p>
                                </div>
                            </div>

                            <!-- ROW 4 (timeline) -->
                            <div class="grid grid-cols-1 gap-8 px-8 py-7 dark:bg-black bg-white lg:grid-cols-2">
                                <!-- LEFT -->

                                <svg width="100%" class=" dark:bg-black bg-white" viewBox="0 0 980 240"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <!-- BG -->


                                    <!-- Arrow Marker -->
                                    <defs>
                                        <marker id="arrow" markerWidth="10" markerHeight="10" refX="9"
                                            refY="5" orient="auto">
                                            <path d="M0,0 L10,5 L0,10 Z" fill="#0B45FF"></path>
                                        </marker>
                                    </defs>

                                    <!-- SETTINGS -->
                                    <!-- y center -->
                                    <!-- Circle radius -->
                                    <!-- distances: 8 steps -->
                                    <!-- X positions -->
                                    <!-- 1..8 -->
                                    <!-- 80 190 300 410 520 630 740 850 -->

                                    <!-- Main line (base) -->
                                    <line x1="80" y1="120" x2="850" y2="120"
                                        stroke="#0B45FF" stroke-width="4" />

                                    <!-- Arrow segments -->
                                    <line x1="60" y1="120" x2="170" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="190" y1="120" x2="280" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="300" y1="120" x2="390" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="410" y1="120" x2="500" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="520" y1="120" x2="610" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="630" y1="120" x2="720" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />
                                    <line x1="740" y1="120" x2="830" y2="120"
                                        stroke="#0B45FF" stroke-width="4" marker-end="url(#arrow)" />

                                    <!-- ===================== -->
                                    <!-- STEP 1 : TOP -->
                                    <g>
                                        <line x1="80" y1="40" x2="80" y2="95"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="92" y="50" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Development</text>

                                        <circle cx="80" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="80" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="80" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">1</text>
                                    </g>

                                    <!-- STEP 2 : BOTTOM -->
                                    <g>
                                        <line x1="190" y1="145" x2="190" y2="205"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="202" y="224" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Proofing</text>

                                        <circle cx="190" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="190" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="190" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">2</text>
                                    </g>

                                    <!-- STEP 3 : TOP -->
                                    <g>
                                        <line x1="300" y1="40" x2="300" y2="95"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="312" y="50" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Final Demo</text>

                                        <circle cx="300" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="300" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="300" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">3</text>
                                    </g>

                                    <!-- STEP 4 : BOTTOM -->
                                    <g>
                                        <line x1="410" y1="145" x2="410" y2="205"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="422" y="224" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Deployment</text>

                                        <circle cx="410" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="410" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="410" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">4</text>
                                    </g>

                                    <!-- STEP 5 : TOP -->
                                    <g>
                                        <line x1="520" y1="40" x2="520" y2="95"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="532" y="50" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Training</text>

                                        <circle cx="520" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="520" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="520" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">5</text>
                                    </g>

                                    <!-- STEP 6 : BOTTOM -->
                                    <g>
                                        <line x1="630" y1="145" x2="630" y2="205"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="642" y="224" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Simulation</text>

                                        <circle cx="630" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="630" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="630" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">6</text>
                                    </g>

                                    <!-- STEP 7 : TOP -->
                                    <g>
                                        <line x1="740" y1="40" x2="740" y2="95"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="752" y="50" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">Finishing</text>

                                        <circle cx="740" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="740" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="740" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">7</text>
                                    </g>

                                    <!-- STEP 8 : BOTTOM -->
                                    <g>
                                        <line x1="850" y1="145" x2="850" y2="205"
                                            stroke="#39C7FF" stroke-width="3" />
                                        <text x="862" y="224" font-size="18" fill="#6B7280" font-family="Arial"
                                            font-weight="500">UAT</text>

                                        <circle cx="850" cy="120" r="24" fill="#DDE6FF"></circle>
                                        <circle cx="850" cy="120" r="18" fill="#0B45FF"></circle>
                                        <text x="850" y="126" text-anchor="middle" font-size="16" fill="#FFFFFF"
                                            font-family="Arial" font-weight="700">8</text>
                                    </g>

                                </svg>

                                <!-- RIGHT (description text like screenshot) -->
                                <div class="text-xs leading-5 text-gray-600">
                                    <p class="font-semibold text-black dark:text-white">
                                        Software Development Life Cycle
                                    </p>
                                    <p class="mt-2">
                                        After we have finished with initial development, the implementation went
                                        through several phase / period.
                                    </p>
                                </div>
                            </div>


                            <!-- ROW 5 -->
                            <div class="grid grid-cols-1 gap-8 px-8 py-7 lg:grid-cols-2">
                                <div class="text-xs leading-5 text-gray-600">
                                    <p>
                                        We will maintain your application with proactive on business
                                        hour that makes your business run smoothly.
                                    </p>
                                </div>

                                <div class="text-xs leading-5 text-gray-700">
                                    <p class="font-semibold dark:text-white text-black">Document Provided</p>
                                    <ul class="mt-2 space-y-1">
                                        <li>• Monthly Testing Checklist</li>
                                        <li>• Minor Technical Improvement</li>
                                        <li>• Notification of errors, updates</li>
                                        <li>• SLA based on requested scope</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta/>
</x-layouts.web>
