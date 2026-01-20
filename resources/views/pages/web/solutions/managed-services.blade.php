<?php

use function Laravel\Folio\name;

name('web.solutions.managed-services');
?>
<x-layouts.web :title="__('Managed IT Services: Scalable and Secure by YE')" :description="__('YE provides managed IT services with robust cloud, security, and system maintenance for long-term growth.')" :keywords="__('managed services, it, cloud, maintenance')">
    
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
                            Managed Services
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

            <img src="{{ asset('assets/media/solutions/managed-it-services.jpg') }}"
                alt="Agile Development" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
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
                            Managed Services</p>
                        <ul>
                            <li class="text-lg font-semibold text-blue-600 py-5">PROACTIIVE SUPPORT</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">SLA TO MEET</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">INTERACTIVE HELP DESK</li>
                        </ul>
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Proactive Support on Business Hour
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We will maintain your application with proactive on business hour that
                                make your business run smoothly
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                SLA to Meet
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Our team work under SLA to support your application and ensure your
                                Business is doing well
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Expected Performance to be Tracked
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">You can track every single ticket in Project Management Tools and we will
                                provide reporting file every month, so you have no worries in your Business
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Interactive Helpdesk
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We provide an Interactive Helpdesk that will help you to communicate with
                                our Costumer Care
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Knowledge Base Library
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We will help you to transfer knowledge in the end of Managed Service
                                period, with the Knowledge Base Library the process will be more easier for your
                                internal team to handle the application in the future
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Support for Every Application
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We can support for all of your application even if the application is not
                                our product
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Support for Every Application
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">We can support for all of your application even if the application is not
                                our product
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
                        <div class="h-[2px] w-full max-w-[420px] dark:bg-white/35 bg-black/35"></div>

                        <h2 class="mt-8 text-[44px] font-extrabold leading-[1.05] dark:text-white text-black">
                            Manage Service<br />
                            Expertise
                        </h2>
                    </div>

                    <!-- RIGHT -->
                    <div class="flex flex-col items-center">
                        <!-- TOP GRID -->
                        <div class="grid w-full max-w-[620px] grid-cols-3 gap-x-10 gap-y-14 text-center">
                            <!-- 1 -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <!-- Android -->
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M20 20l-4-6M44 20l4-6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M17 26c3-6 10-10 15-10s12 4 15 10" stroke="currentColor"
                                            stroke-width="3" stroke-linecap="round" />
                                        <path d="M16 28h32v18a10 10 0 0 1-10 10H26A10 10 0 0 1 16 46V28Z"
                                            stroke="currentColor" stroke-width="3" />
                                        <path d="M24 38h0M40 38h0" stroke="currentColor" stroke-width="6"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="text-[13px] font-extrabold tracking-[0.25em] dark:text-blue-600 text-blue-600">
                                    APK</div>
                                <div class="text-sm font-semibold dark:text-white text-black">Android<br />Application
                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <!-- Apple -->
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M40 16c-2 2-4 4-4 7 0 1 0 2 1 3 3 0 6-2 7-4 2-2 3-4 3-7-3 0-5 1-7 1Z"
                                            stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M32 26c5 0 7 3 10 3 3 0 4-2 8-2-1 4-5 6-5 11 0 6 5 8 5 8-2 5-6 10-10 10-3 0-5-2-8-2s-6 2-9 2c-4 0-8-6-10-11-3-7-1-16 6-19 3-1 6 1 8 1Z"
                                            stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div
                                    class="text-[13px] font-extrabold tracking-[0.25em] dark:text-blue-600 text-blue-600">
                                    APP</div>
                                <div class="text-sm font-semibold dark:text-white text-black">IOS<br />Application
                                </div>
                            </div>

                            <!-- 3 -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <!-- Code -->
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M12 14h40v36H12V14Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M22 26l-6 6 6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M42 26l6 6-6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M28 44l8-24" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="text-[13px] font-extrabold tracking-[0.25em] dark:text-blue-600 text-blue-600">
                                    HTML</div>
                                <div class="text-sm font-semibold dark:text-white text-black">Frontend</div>
                            </div>

                            <!-- 4 -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <!-- Database -->
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M16 20c0 4 7 8 16 8s16-4 16-8-7-8-16-8-16 4-16 8Z"
                                            stroke="currentColor" stroke-width="3" />
                                        <path d="M16 20v24c0 4 7 8 16 8s16-4 16-8V20" stroke="currentColor"
                                            stroke-width="3" />
                                        <path d="M16 32c0 4 7 8 16 8s16-4 16-8" stroke="currentColor"
                                            stroke-width="3" />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold dark:text-white text-black">Backend</div>
                            </div>

                            <!-- 5 -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <!-- Middleware -->
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M12 20h40v10H12V20Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M22 44h20" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M32 30v14" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M24 50h16" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold dark:text-white text-black">Middleware</div>
                            </div>

                            <!-- empty slot biar sama kayak gambar -->
                            <div class="hidden lg:block"></div>
                        </div>

                        <!-- SEPARATOR TEXT -->
                        <div class="my-12 flex w-full max-w-[620px] items-center gap-5">
                            <div class="h-[2px] flex-1 dark:bg-white/35 bg-black/35"></div>
                            <div class="text-sm font-semibold dark:text-white text-black">
                                Or You can choose full system support
                            </div>
                            <div class="h-[2px] flex-1 dark:bg-white/35 bg-black/35"></div>
                        </div>

                        <!-- BOTTOM GRID -->
                        <div class="grid w-full max-w-[620px] grid-cols-3 gap-x-10 gap-y-12 text-center">
                            <!-- Infra -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M22 46h20" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M18 46v6M46 46v6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path
                                            d="M20 40c-4 0-8-3-8-8 0-4 2-7 6-8 1-6 6-10 12-10 5 0 9 2 11 6 4 0 9 3 9 9 0 6-4 11-10 11H20Z"
                                            stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold dark:text-white text-black">Infra</div>
                            </div>

                            <!-- Network -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <circle cx="20" cy="22" r="4" stroke="currentColor"
                                            stroke-width="3" />
                                        <circle cx="44" cy="18" r="4" stroke="currentColor"
                                            stroke-width="3" />
                                        <circle cx="46" cy="42" r="4" stroke="currentColor"
                                            stroke-width="3" />
                                        <circle cx="22" cy="44" r="4" stroke="currentColor"
                                            stroke-width="3" />
                                        <path d="M24 22l16-4" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M22 26l2 14" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M26 44h16" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M44 22l2 16" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold dark:text-white text-black">Network</div>
                            </div>

                            <!-- Apps Source -->
                            <div class="flex flex-col items-center gap-2">
                                <div class="grid h-14 w-14 place-items-center text-blue-600">
                                    <svg class="h-12 w-12" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M18 14h28v36H18V14Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M24 22h16" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M24 30h10" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M46 40l6 2-3 6-6 1-3-5 6-4Z" stroke="currentColor" stroke-width="3"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold dark:text-white text-black">Apps Source</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="relative isolate">
        <section class="py-14">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <!-- TOP TITLE -->
                <div class="max-w-xl">
                    <div class="h-[2px] w-full dark:bg-white/50 bg-black/50"></div>

                    <h2 class="mt-5 text-4xl font-extrabold leading-[1.05] dark:text-white text-black">
                        Workflow for <br />
                        Managed Services
                    </h2>
                </div>

                <!-- BARS -->
                <div class="mt-12 flex justify-center">
                    <div class="w-full max-w-4xl">
                        <!-- Apps bar -->
                        <div class="bg-[#5B5B5F] py-3 text-center text-sm font-semibold text-white">
                            Apps
                        </div>

                        <!-- Client ->YE bar -->
                        <div class="relative mt-4 flex w-full">
                            <div
                                class="flex h-12 w-[32%] items-center justify-center bg-[#0A2EFF] text-sm font-semibold text-white">
                                Client
                            </div>

                            <!-- chevron separator -->
                            <div class="relative w-[4%]">
                                <div class="absolute left-0 top-0 h-full w-full bg-[#0A2EFF]"></div>
                                <div
                                    class="absolute left-[40%] top-0 h-0 w-0 border-y-[24px] border-l-[24px] border-y-transparent border-l-white">
                                </div>
                            </div>

                            <div
                                class="flex h-12 w-[64%] items-center justify-center bg-[#0A2EFF] text-sm font-semibold text-white">
                               YE
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FLOW DIAGRAM -->
                <div class="mt-12 flex justify-center">
                    <div class="w-full max-w-5xl">
                        <div class="rounded-lg dark:bg-black bg-white py-6 ">
                            <svg viewBox="0 0 1200 520" width="100%" xmlns="http://www.w3.org/2000/svg" class=" dark:text-white text-black">

                                <!-- Background -->
                                {{-- <rect width="1200" height="520" /> --}}

                                <!-- Arrow marker -->
                                <defs>
                                    <marker id="arrow" viewBox="0 0 10 10" refX="9" refY="5"
                                        markerWidth="8" markerHeight="8" orient="auto">
                                        <path d="M0,0 L10,5 L0,10 Z" fill="#1E40FF" />
                                    </marker>
                                </defs>

                                <!-- ===================== -->
                                <!-- END USER -->
                                <!-- ===================== -->
                                <g transform="translate(150,270)">
                                    <circle r="70" fill="#E9EEFF" />
                                    <circle r="55" fill="#0A2EFF" />
                                    <!-- icon -->
                                    <circle cx="0" cy="-12" r="10" fill="#ffffff" />
                                    <path d="M-18 22c6-16 30-16 36 0" stroke="#ffffff" stroke-width="6"
                                        fill="none" stroke-linecap="round" />
                                    <!-- label -->
                                    <text x="-40" y="105" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">End User</text>
                                </g>

                                <!-- ===================== -->
                                <!-- CLIENT PIC -->
                                <!-- ===================== -->
                                <g transform="translate(390,270)">
                                    <circle r="70" fill="#E9EEFF" />
                                    <circle r="55" fill="#0A2EFF" />
                                    <!-- icon -->
                                    <circle cx="0" cy="-12" r="10" fill="#ffffff" />
                                    <path d="M-18 22c6-16 30-16 36 0" stroke="#ffffff" stroke-width="6"
                                        fill="none" stroke-linecap="round" />
                                    <!-- tie -->
                                    <path d="M-10 16l10 14 10-14" stroke="#ffffff" stroke-width="5" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <!-- label -->
                                    <text x="-35" y="90" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Client PIC</text>
                                </g>

                                <!-- ===================== -->
                                <!-- PM TOOLS -->
                                <!-- ===================== -->
                                <g transform="translate(610,110)">
                                    <!-- icon: document + pencil -->
                                    <path d="M-22 -18h30l10 10v30h-40z" fill="none" stroke="#1E40FF"
                                        stroke-width="3" />
                                    <path d="M8 -18v10h10" fill="none" stroke="#1E40FF" stroke-width="3" />
                                    <path d="M-8 6l18-18" stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <path d="M-10 10l6 2-2-6z" fill="#1E40FF" />
                                    <!-- label -->
                                    <text x="-30" y="87" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">PM Tools</text>
                                </g>

                                <!-- ===================== -->
                                <!-- BUG FIXING -->
                                <!-- ===================== -->
                                <g transform="translate(1030,110)">
                                    <!-- icon: laptop + gear -->
                                    <rect x="-26" y="-18" width="52" height="36" rx="4"
                                        fill="none" stroke="#1E40FF" stroke-width="3" />
                                    <line x1="-18" y1="10" x2="18" y2="10"
                                        stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <circle cx="0" cy="-2" r="6" fill="none" stroke="#1E40FF"
                                        stroke-width="3" />
                                    <line x1="0" y1="-12" x2="0" y2="-8"
                                        stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <line x1="0" y1="4" x2="0" y2="8"
                                        stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <line x1="-10" y1="-2" x2="-6" y2="-2"
                                        stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <line x1="6" y1="-2" x2="10" y2="-2"
                                        stroke="#1E40FF" stroke-width="3" stroke-linecap="round" />
                                    <!-- label -->
                                    <text x="-40" y="45" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Bug Fixing</text>
                                </g>

                                <!-- ===================== -->
                                <!-- CUSTOMER CAREYE -->
                                <!-- ===================== -->
                                <g transform="translate(690,290)">
                                    <circle r="36" fill="#22B7E8" />
                                    <circle cx="0" cy="-8" r="8" fill="#ffffff" />
                                    <path d="M-14 16c4-10 24-10 28 0" stroke="#ffffff" stroke-width="4"
                                        fill="none" stroke-linecap="round" />
                                    <text x="-65" y="70" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Customer Care</text>
                                    <text x="-18" y="90" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">YE</text>
                                </g>

                                <!-- ===================== -->
                                <!-- SUPPORT TEAM -->
                                <!-- ===================== -->
                                <g transform="translate(880,290)">
                                    <circle r="36" fill="#22B7E8" />
                                    <circle cx="0" cy="-8" r="8" fill="#ffffff" />
                                    <path d="M-14 16c4-10 24-10 28 0" stroke="#ffffff" stroke-width="4"
                                        fill="none" stroke-linecap="round" />
                                    <text x="-40" y="70" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Support</text>
                                    <text x="-28" y="90" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Team</text>
                                </g>

                                <!-- ===================== -->
                                <!-- BUGS / FLOW -->
                                <!-- ===================== -->
                                <g transform="translate(1030,290)">
                                    <!-- bug icon -->
                                    <circle r="18" fill="none" stroke="#1E40FF" stroke-width="4" />
                                    <line x1="0" y1="-18" x2="0" y2="18"
                                        stroke="#1E40FF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="-16" y1="-8" x2="-26" y2="-8"
                                        stroke="#1E40FF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="16" y1="-8" x2="26" y2="-8"
                                        stroke="#1E40FF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="-16" y1="8" x2="-26" y2="8"
                                        stroke="#1E40FF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="16" y1="8" x2="26" y2="8"
                                        stroke="#1E40FF" stroke-width="4" stroke-linecap="round" />
                                    <text x="-42" y="70" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">Bugs / Flow</text>
                                </g>

                                <!-- ===================== -->
                                <!--YE CHAT -->
                                <!-- ===================== -->
                                <g transform="translate(610,445)">
                                    <circle cx="-12" cy="-6" r="10" fill="none" stroke="#1E40FF"
                                        stroke-width="3" />
                                    <path d="M-25 22c4-14 22-14 26 0" stroke="#1E40FF" stroke-width="3"
                                        fill="none" stroke-linecap="round" />
                                    <path d="M10 -10h42v29H20l-15 12V-10z" fill="none" stroke="#1E40FF"
                                        stroke-width="3" stroke-linejoin="round" />
                                    <text x="-18" y="65" font-family="Arial" font-size="16" font-weight="700"
                                        fill="currentColor">YE Chat</text>
                                </g>

                                <!-- ===================== -->
                                <!-- CONNECTION LINES + LABELS -->
                                <!-- ===================== -->

                                <!-- End User -> Client PIC (Rep) -->
                                <line x1="230" y1="250" x2="320" y2="250" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />
                                <text x="265" y="225" font-family="Arial" font-size="16" fill="#8A8A8A">Rep</text>

                                <!-- Client PIC -> End User (Solutions) -->
                                <line x1="320" y1="290" x2="230" y2="290" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />
                                <text x="250" y="320" font-family="Arial" font-size="16"
                                    fill="#8A8A8A">Solutions</text>

                                <!-- Client PIC -> PM Tools (Check Ticket Status) -->
                                <path d="M390 200 V150 H560" stroke="#1E40FF" stroke-width="3" fill="none"
                                    marker-end="url(#arrow)" />
                                <text x="410" y="125" font-family="Arial" font-size="16" fill="#8A8A8A">Check Ticket
                                    Status</text>

                                <!-- PM Tools -> Bug Fixing (Ticket Done) -->
                                <line x1="650" y1="90" x2="980" y2="90" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />
                                <text x="790" y="65" font-family="Arial" font-size="16" fill="#8A8A8A">Ticket
                                    Done</text>

                                <!-- Bug Fixing -> PM Tools (Receive Ticket) -->
                                <line x1="980" y1="135" x2="650" y2="135" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />
                                <text x="790" y="160" font-family="Arial" font-size="16" fill="#8A8A8A">Receive
                                    Ticket</text>

                                <!-- Client PIC -> Customer Care (Receive Ticket) -->
                                <path d="M600 290 V400 V290 H650" stroke="#1E40FF" stroke-width="3" fill="none"
                                    marker-end="url(#arrow)" />
                                <text x="570" y="245" font-family="Arial" font-size="16" fill="#8A8A8A">Receive
                                    Ticket</text>

                                <!-- Customer Care -> Support Team -->
                                <line x1="726" y1="290" x2="835" y2="290" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />

                                <!-- Support Team -> Bugs/Flow -->
                                <line x1="916" y1="290" x2="990" y2="290" stroke="#1E40FF"
                                    stroke-width="3" fill="none" marker-end="url(#arrow)" />
                                <text x="770" y="260" font-family="Arial" font-size="16" fill="#8A8A8A">Create
                                    Ticket</text>

                                <!-- Bugs/Flow -> Bug Fixing (vertical up then left) -->
                                <path d="M1080 290 V190 H670" stroke="#1E40FF" stroke-width="3" fill="none"
                                    marker-end="url(#arrow)" />

                                <!-- Client PIC ->YE Chat (Report) -->
                                <path d="M390 345 V410 H560" stroke="#1E40FF" stroke-width="3" fill="none"
                                    marker-end="url(#arrow)" />
                                <text x="370" y="435" font-family="Arial" font-size="16" fill="#8A8A8A">Report</text>

                                <!--YE Chat -> Bugs/Flow (Inform Application’s flow/bugs) -->
                                <path d="M665 450 H1080 V330" stroke="#1E40FF" stroke-width="3" fill="none" />
                                <path d="M1080 330 V315" stroke="#1E40FF" stroke-width="3" fill="none"
                                    marker-end="url(#arrow)" />
                                <text x="750" y="470" font-family="Arial" font-size="16" fill="#8A8A8A">Inform
                                    Application’s flow/bugs</text>

                            </svg>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta />
</x-layouts.web>
