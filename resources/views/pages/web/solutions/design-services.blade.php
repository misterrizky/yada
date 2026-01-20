<?php

use function Laravel\Folio\name;

name('web.solutions.design-services');
?>
<x-layouts.web :title="__('UX/UI &amp; Design Services: Build Intuitive Experiences	')" :description="__('YE design team helps create seamless digital experiences through UI/UX, research, and design strategy.')" :keywords="__('ux, ui, design, user experience')">
    
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
                            Design Services
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

            <img src="{{ asset('assets/media/solutions/design-services.jpg') }}"
                alt="Agile Development" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <hr class="h-px my-6 bg-gray-200 dark:bg-gray-700">
                        <p
                            class="mt-2 text-6xl font-extrabold leading-[1.05] tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Advantage of<br>
                            Design Services</p>
                        <ul>
                            <li class="text-lg font-semibold text-blue-600 py-5">QUALIFIED AND EXPERIENCE DESIGNER</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">DESIGN THINKING</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">IMPROVE USABILITY</li>
                        </ul>
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Qualified and Experience Designer
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Our highly experienced and qualified designers hands-on experience in
                                cutting-edge tools ensure the measurable results and finest web designs.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Striking Design
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Being the IT company Indonesia, we possess the expertise required for
                                creating striking and eye-catching graphical designs for flyers, brochures, flexes,
                                advertisements, Emailers and many more.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Client Centric Design Services
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">You can track every single ticket in Project Management Tools and we will
                                provide reporting file every month, so you have no worries in your Business
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Improve Usability
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Our interactive designs created with emphasis not only on the visual
                                appeal, but also on the functionality deliver improved usability, and increased brand
                                cognizance.
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
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-[520px_1fr] lg:items-start">
                    <!-- LEFT -->
                    <div>
                        <div class="h-[2px] w-full max-w-[430px] dark:bg-white/40 bg-black/40"></div>

                        <h2 class="mt-8 text-6xl font-extrabold leading-[1.05] dark:text-white text-black">
                            Design Expertise
                        </h2>

                        <p class="mt-8 max-w-[520px] text-[15px] leading-7 dark:text-white/55 text-black/55">
                            With more than +15 years of experience, YE is one of the most experienced
                            design companies. Our expertise, as well as our passion for web design,
                            sets us apart from other agencies. Plus, our experience demonstrates our
                            ability to learn and adapt to the latest industry standards.
                        </p>
                    </div>

                    <!-- RIGHT -->
                    <div class="grid grid-cols-1 gap-x-10 gap-y-8 sm:grid-cols-2">
                        <!-- COLUMN 1 -->
                        <div class="space-y-6">
                            <!-- Item -->
                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <!-- icon -->
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M10 14h44v26H10V14Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M18 22h18" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M18 30h12" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M22 50h20" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M18 40l6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M46 40l-6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    UI Website Design
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M16 18h32v28H16V18Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M22 26h12" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M22 34h8" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M44 44l8 8" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <circle cx="44" cy="44" r="6" stroke="currentColor"
                                            stroke-width="3" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    UX Research
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M20 44c10 6 22 1 26-8" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M22 22c-6 6-6 16 0 22 6 6 16 6 22 0" stroke="currentColor"
                                            stroke-width="3" />
                                        <path d="M46 16l6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M40 14l10 10" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M46 16l-10 4 4-10" stroke="currentColor" stroke-width="3"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    Icon Illustration
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M18 18h18v18H18V18Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M30 30h16v16H30V30Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M18 46h10" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M36 18h10" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    Social Media
                                </div>
                            </div>
                        </div>

                        <!-- COLUMN 2 -->
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M22 12h20v40H22V12Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M26 18h12" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                        <path d="M32 46h0" stroke="currentColor" stroke-width="6"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    UI Mobile Design
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M12 16h40v26H12V16Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M22 26l-6 6 6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M42 26l6 6-6 6" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M28 44l8-24" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    HTML Responsive
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M18 28l18-10 10 18-18 10-10-18Z" stroke="currentColor"
                                            stroke-width="3" />
                                        <path d="M30 32c4 0 6-2 8-5" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    Branding Identity
                                </div>
                            </div>

                            <div class="flex items-start gap-4 border-b border-black/15 dark:border-white/15 pb-6">
                                <div class="mt-0.5 text-blue-700">
                                    <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                        <path d="M18 18h28v18H18V18Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M14 28h36v18H14V28Z" stroke="currentColor" stroke-width="3" />
                                        <path d="M26 36h12" stroke="currentColor" stroke-width="3"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="pt-1 text-base font-semibold dark:text-white text-black">
                                    Print Design
                                </div>
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
                <!-- Title -->
                <div class="max-w-xl">
                    <div class="h-[2px] w-full bg-black/50 dark:bg-white/50"></div>
                    <h2 class="mt-5 text-4xl font-extrabold leading-[1.05] text-black dark:text-white">
                        Workflow for <br />
                        Design Services
                    </h2>
                </div>

                <!-- ===== TOP FLOW ===== -->
                <div class="mt-10 flex justify-center">
                    <div class="relative w-full max-w-6xl">
                        <svg viewBox="0 0 1400 520" class="h-auto w-full dark:text-white text-black"
                            xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <!-- arrow marker (soft blue) -->
                                <marker id="softArrow" viewBox="0 0 10 10" refX="9" refY="5"
                                    markerWidth="7" markerHeight="7" orient="auto">
                                    <path d="M0,0 L10,5 L0,10 Z" fill="#C9D6F6"></path>
                                </marker>
                            </defs>

                            <!-- =========================
              TOP ARCS (ITERATION)
          ========================== -->
                            <!-- big loop: Implement -> Empathize -->
                            <path d="M 1250 250
               C 1120 35, 520 35, 150 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <!-- medium loop: Prototype -> Empathize -->
                            <path d="M 760 250
               C 660 90, 360 90, 150 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <!-- small arcs above steps -->
                            <path d="M 360 250
               C 305 165, 215 165, 150 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <path d="M 560 250
               C 505 165, 415 165, 360 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <path d="M 760 250
               C 705 165, 615 165, 560 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <path d="M 980 250
               C 925 165, 835 165, 760 245" fill="none" stroke="#C9D6F6" stroke-width="3"
                                marker-end="url(#softArrow)" />

                            <!-- =========================
              LABELS (TOP TEXT)
          ========================== -->
                            <text x="95" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Empathize</text>
                            <text x="320" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Define</text>
                            <text x="535" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Ideate</text>
                            <text x="705" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Prototype</text>
                            <text x="955" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Test</text>
                            <text x="1165" y="235" font-family="Arial" font-size="26" font-weight="700"
                                fill="currentColor">Implement</text>

                            <!-- =========================
              CIRCLES + ICONS
          ========================== -->
                            <!-- Positions:
            1: (150,360)
            2: (360,360)
            3: (560,360)
            4: (760,360)
            5: (980,360)
            6: (1250,360)
          -->

                            <!-- ===== 1 Empathize ===== -->
                            <g>
                                <!-- ring with gap -->
                                <circle cx="150" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />

                                <!-- soft shine wedge -->

                                <!-- icon: user + heart -->
                                <circle cx="150" cy="338" r="10" fill="none" stroke="#001DFF"
                                    stroke-width="4" />
                                <path d="M150 406
                 C140 396,125 386,125 372
                 C125 362,133 355,142 355
                 C147 355,151 358,150 363
                 C149 358,153 355,158 355
                 C167 355,175 362,175 372
                 C175 386,160 396,150 406Z" fill="none" stroke="#001DFF" stroke-width="4"
                                    stroke-linejoin="round" />

                                <!-- next arrow -->
                                <path d="M 252 388 L 276 360 L 252 332 Z" fill="#001DFF" opacity="0.18" />
                                <path d="M 246 388 L 270 360 L 246 332 Z" fill="#001DFF" />
                            </g>

                            <!-- ===== 2 Define ===== -->
                            <g>
                                <circle cx="360" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />



                                <!-- icon: magnifier -->
                                <circle cx="350" cy="355" r="24" fill="none" stroke="#001DFF"
                                    stroke-width="5" />
                                <path d="M 370 375 L 392 397" stroke="#001DFF" stroke-width="5"
                                    stroke-linecap="round" />

                                <path d="M 462 388 L 486 360 L 462 332 Z" fill="#001DFF" opacity="0.18" />
                                <path d="M 456 388 L 480 360 L 456 332 Z" fill="#001DFF" />
                            </g>

                            <!-- ===== 3 Ideate ===== -->
                            <g>
                                <circle cx="560" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />

                                {{-- <path d="M 630 300
                 A 92 92 0 0 1 630 420
                 L 600 410
                 A 62 62 0 0 0 600 310
                 Z" fill="#EAF0FF" opacity="0.6" /> --}}

                                <!-- icon: bulb -->
                                <path d="M560 332
                 C540 332,530 348,530 362
                 C530 380,545 388,545 400
                 H575
                 C575 388,590 380,590 362
                 C590 348,580 332,560 332Z" fill="none" stroke="#001DFF" stroke-width="5"
                                    stroke-linejoin="round" />
                                <path d="M548 406 H572" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />
                                <path d="M552 420 H568" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />

                                <path d="M 662 388 L 686 360 L 662 332 Z" fill="#001DFF" opacity="0.18" />
                                <path d="M 656 388 L 680 360 L 656 332 Z" fill="#001DFF" />
                            </g>

                            <!-- ===== 4 Prototype ===== -->
                            <g>
                                <circle cx="760" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />



                                <!-- icon: pen + ruler -->
                                <rect x="735" y="335" width="14" height="70" rx="6" fill="none"
                                    stroke="#001DFF" stroke-width="5" />
                                <path d="M742 335 V320" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />

                                <rect x="770" y="315" width="18" height="90" rx="6" fill="none"
                                    stroke="#001DFF" stroke-width="5" />
                                <path d="M770 390 H788" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />

                                <path d="M 862 388 L 886 360 L 862 332 Z" fill="#001DFF" opacity="0.18" />
                                <path d="M 856 388 L 880 360 L 856 332 Z" fill="#001DFF" />
                            </g>

                            <!-- ===== 5 Test ===== -->
                            <g>
                                <circle cx="980" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />



                                <!-- icon: checklist -->
                                <rect x="940" y="328" width="80" height="70" rx="8" fill="none"
                                    stroke="#001DFF" stroke-width="5" />
                                <path d="M960 350 L970 360 L985 340" stroke="#001DFF" stroke-width="5" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M960 380 L970 390" stroke="#001DFF" stroke-width="5"
                                    stroke-linecap="round" />
                                <path d="M970 380 L960 390" stroke="#001DFF" stroke-width="5"
                                    stroke-linecap="round" />
                                <path d="M995 355 H1015" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />
                                <path d="M995 385 H1015" stroke="#001DFF" stroke-width="5" stroke-linecap="round" />

                                <path d="M 1082 388 L 1106 360 L 1082 332 Z" fill="#001DFF" opacity="0.18" />
                                <path d="M 1076 388 L 1100 360 L 1076 332 Z" fill="#001DFF" />
                            </g>

                            <!-- ===== 6 Implement ===== -->
                            <g>
                                <circle cx="1250" cy="360" r="92" fill="none" stroke="#001DFF"
                                    stroke-width="6" stroke-linecap="round" stroke-dasharray="520 90"
                                    stroke-dashoffset="40" />



                                <!-- icon: rocket -->
                                <path d="M1250 320
                 C1278 340,1278 380,1250 400
                 C1222 380,1222 340,1250 320Z" fill="none" stroke="#001DFF" stroke-width="5"
                                    stroke-linejoin="round" />
                                <circle cx="1250" cy="355" r="7" fill="none" stroke="#001DFF"
                                    stroke-width="5" />
                                <path d="M1232 380 L1218 392" stroke="#001DFF" stroke-width="5"
                                    stroke-linecap="round" />
                                <path d="M1268 380 L1282 392" stroke="#001DFF" stroke-width="5"
                                    stroke-linecap="round" />

                                <!-- tail line (like photo) -->
                                <path d="M 1340 408 L 1380 320" stroke="#001DFF" stroke-width="6"
                                    stroke-linecap="round" />
                            </g>
                        </svg>
                    </div>
                </div>

                <!-- ===== BOTTOM 3 STEPS ===== -->
                <div class="mt-14 flex justify-center">
                    <div class="w-full max-w-6xl">
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                            <!-- Understand -->
                            <div>
                                <div
                                    class="relative bg-blue-500 px-6 py-4 text-center text-sm font-semibold text-black">
                                    Understand
                                    <div
                                        class="absolute right-0 top-0 h-0 w-0 border-y-[26px] border-l-[26px] border-y-transparent border-l-white">
                                    </div>
                                </div>

                                <p class="mt-4 text-sm leading-6 text-gray-600">
                                    A problem statement identifies the gap between the current state
                                    (i.e. the problem) and the desired state (i.e. the goal) of a
                                    process or product. Within the design context, you can think
                                    of the user problem as an unmet need.
                                </p>
                            </div>

                            <!-- Explore -->
                            <div>
                                <div
                                    class="relative bg-blue-500 px-6 py-4 text-center text-sm font-semibold text-black">
                                    Explore
                                    <div
                                        class="absolute right-0 top-0 h-0 w-0 border-y-[26px] border-l-[26px] border-y-transparent border-l-white">
                                    </div>
                                </div>

                                <p class="mt-4 text-sm leading-6 text-gray-600">
                                    At this stage, we can start exploring possibilities and thinking
                                    of ideas to solve the problem or problems we identified.
                                </p>
                            </div>

                            <!-- Materialize -->
                            <div>
                                <div class="bg-blue-500 px-6 py-4 text-center text-sm font-semibold text-black">
                                    Materialize
                                </div>

                                <p class="mt-4 text-sm leading-6 text-gray-600">
                                    This step was once we got immediate feedback from a potential
                                    customer during a prototype-testing session.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta />
</x-layouts.web>
