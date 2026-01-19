<?php

use function Laravel\Folio\name;

name('web.solutions.information-system');
?>
<x-layouts.web :title="__('Information System')" :description="__('')">
    
    <div class="relative isolate">
        <section class="bg-white py-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <!-- TOP -->
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-start">
                    <!-- LEFT -->
                    <div>
                        <p class="text-xs font-bold tracking-[0.35em] text-blue-700">
                            TECH INTEGRATION
                        </p>

                        <h2 class="mt-4 text-5xl font-extrabold tracking-tight text-black">
                            WGS Solutions
                        </h2>
                    </div>

                    <!-- RIGHT -->
                    <div class="lg:pt-2">
                        <p class="max-w-xl text-sm leading-relaxed text-black/80">
                            Perpetually keeping ahead of technology is essential in FutureProof
                            Innovation.
                        </p>
                    </div>
                </div>

                <!-- BOTTOM -->
                <div class="mt-14 flex flex-col gap-8 lg:flex-row lg:items-center">
                    <!-- Label -->
                    <div class="flex items-center gap-6">
                        <p class="text-base font-semibold text-black">
                            Information System
                        </p>

                        <!-- Vertical line -->
                        <div class="h-10 w-[2px] bg-black/20"></div>
                    </div>

                    <!-- Logos -->
                    <div class="flex flex-wrap items-center gap-x-10 gap-y-6">
                        <img src="https://dummyimage.com/90x28/000/fff&text=appian" alt="Appian"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/70x28/000/fff&text=IBM" alt="IBM"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/90x28/000/fff&text=invigate" alt="Invigate"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/75x28/000/fff&text=JOSYS" alt="JOSYS"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/85x28/000/fff&text=nintex" alt="Nintex"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/115x28/000/fff&text=OCEANBASE" alt="OceanBase"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/95x28/000/fff&text=Rocket" alt="Rocket Software"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/70x28/000/fff&text=SOTI" alt="SOTI"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/70x28/000/fff&text=ula" alt="ula"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/120x28/000/fff&text=Wolters+Kluwer" alt="Wolters Kluwer"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />

                        <img src="https://dummyimage.com/95x28/000/fff&text=ZYCUS" alt="ZYCUS"
                            class="h-6 w-auto opacity-80 hover:opacity-100 transition" />
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="relative isolate">
        <section class="bg-[#f6f7fb] py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-14 lg:grid-cols-[320px_1fr]">
                    <!-- LEFT (Sticky) -->
                    <aside class="lg:sticky lg:top-30 lg:self-start">
                        <h2 class="text-4xl font-extrabold leading-tight text-black">
                            Information<br />
                            System
                        </h2>

                        <p class="mt-6 max-w-[260px] text-sm leading-7 text-black/50">
                            Our capabilities are our valuable assets that you can leverage.
                            Our unique delivery model will enable your company to achieve your
                            business goal.
                        </p>
                    </aside>

                    <!-- RIGHT (List) -->
                    <div class="space-y-16">
                        <!-- ITEM 1 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <!-- Image -->
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1200&auto=format&fit=crop"
                                    alt="Appian" class="h-[170px] w-full object-cover" />
                            </div>

                            <!-- Content -->
                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">appian</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Appian Business Process Management (BPM): Helps businesses
                                        automate business processes, expedite approval times, and
                                        improve efficiency.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 2 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1526378722484-bd91ca387e72?q=80&w=1200&auto=format&fit=crop"
                                    alt="IBM WatsonX" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">IBM</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Harness the power of AI with IBM WatsonX Partner Indonesia.
                                        Boost customer service, detect fraud, and accelerate product
                                        development.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 3 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?q=80&w=1200&auto=format&fit=crop"
                                    alt="Invigate" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">invgate</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        INVGATE: Powerful ITSM and ITAM for Enhanced Efficiency and
                                        Control
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 4 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200&auto=format&fit=crop"
                                    alt="Josys" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">JOSYS</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        JOSYS provides comprehensive visibility into all SaaS
                                        applications in use within an organization.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 5 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=1200&auto=format&fit=crop"
                                    alt="Nintex" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">nintex</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Nintex Robotic Process Automation: Automate repetitive tasks and
                                        boost efficiency
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 6 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=1200&auto=format&fit=crop"
                                    alt="OceanBase" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">OCEANBASE</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        OceanBase: Distributed SQL Database Engineered for
                                        Enterprise-Grade Performance and Scale
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 7 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200&auto=format&fit=crop"
                                    alt="Rocket Software" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">Rocket Software</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Rocket Software AS/400 Software Modernization is the solution to
                                        evolve and ensure business growth.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 8 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?q=80&w=1200&auto=format&fit=crop"
                                    alt="SOTI" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">SOTI</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        SOTI providing a comprehensive suite of mobile and IoT
                                        management solutions that empower organizations to secure,
                                        manage, and optimize their connected devices.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 9 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200&auto=format&fit=crop"
                                    alt="ula" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">ula</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        ULA offering a unified infrastructure and log analytics
                                        solution that leverages the power of AIOps to streamline IT
                                        operations and empower businesses.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 10 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1524492449090-26c02f0b8b32?q=80&w=1200&auto=format&fit=crop"
                                    alt="Wolters Kluwer" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">Wolters Kluwer</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Wolters Kluwer provides valuable information and solutions to
                                        improve business performance.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>

                        <!-- ITEM 11 -->
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:items-start">
                            <div class="overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1200&auto=format&fit=crop"
                                    alt="Zycus" class="h-[170px] w-full object-cover" />
                            </div>

                            <div class="flex items-start justify-between gap-8">
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center bg-white px-4 py-2">
                                        <span class="text-sm font-bold text-blue-700">ZYCUS</span>
                                    </div>

                                    <p class="mt-6 text-sm leading-7 text-black/60">
                                        Zycus specializes in Source-to-Pay (S2P) solutions that
                                        streamline procurement activities.
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:opacity-80 transition">
                                    Learn More
                                    <span class="text-lg">↗</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.web>
