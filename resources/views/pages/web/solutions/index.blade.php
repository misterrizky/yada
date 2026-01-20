<?php

use function Laravel\Folio\name;

name('web.solutions');
?>
<x-layouts.web :title="__('Enterprise Solutions: AI, Cloud, Apps by YE')" :description="__('End-to-end solutions for retail, finance, and more using AI, big data, cloud, and web/mobile apps.')" :keywords="__('enterprise solutions, digital, industry')">
    <div class="relative isolate overflow-x-hidden">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true"
                    class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block dark:fill-black">
                    <polygon points="0,0 90,0 50,100 0,100" />
                </svg>

                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-56 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <div class="hidden sm:mb-10 sm:flex">
                            <div
                                class="relative rounded-full px-3 py-1 text-sm/6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20 dark:text-gray-400 dark:ring-white/10 dark:hover:ring-white/20">
                                <a href="#"
                                    class="font-semibold whitespace-nowrap text-indigo-600 dark:text-indigo-400"><span
                                        aria-hidden="true" class="absolute inset-0"></span>Read more <span
                                        aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                        <h1
                            class="text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl dark:text-white split-text">
                            YE Capacities</h1>
                        <p
                            class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8 dark:text-gray-400 split-text">
                            Project, Agile, Managed Services</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 dark:bg-gray-800">
            <img src="{{ asset('assets/media/solutions/software-development.jpg') }}"
                alt="" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate overflow-x-hidden">
        <section class="relative px-10 py-20 max-w-7xl mx-auto gsap-fade-up">

            <!-- Header -->
            <div class="mb-16">
                <p class="text-xs tracking-widest uppercase mb-4">
                    Futureproof 360°
                </p>
                <div class="h-px w-56 bg-white mb-6"></div>
                <h1 class="text-5xl font-bold">
                    Our Expertise
                </h1>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 relative">

                <!-- Vertical Lines -->
                <div class="hidden md:block absolute left-1/3 top-0 h-full w-px dark:bg-white/40 bg-black"></div>
                <div class="hidden md:block absolute left-2/3 top-0 h-full w-px dark:bg-white/40 bg-black"></div>

                <!-- Column 1 -->
                <div class="space-y-6">
                    <!-- Icon -->
                    <svg class="w-10 h-10" viewBox="0 0 48 48" fill="none">
                        <path d="M30 10a14 14 0 1 1-8-2" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" />
                        <path d="M30 10h8v8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <p class="text-sm font-semibold">01.</p>
                    <h3 class="text-2xl font-bold">AGILE DELIVERY</h3>
                    <p class="text-xs tracking-widest uppercase">
                        Digital Transformation Solution
                    </p>

                    <ul class="list-disc list-inside space-y-2 mt-6">
                        <li>Agile Delivery</li>
                        <li>Managed Services</li>
                        <li>Consulting</li>
                    </ul>
                </div>

                <!-- Column 2 -->
                <div class="space-y-6">
                    <!-- Icon -->
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 15a4 4 0 004 4h10a4 4 0 000-8 5 5 0 00-9.9-1A4 4 0 003 15z" />
                    </svg>

                    <p class="text-sm font-semibold">02.</p>
                    <h3 class="text-2xl font-bold">CLOUD INTEGRATION</h3>
                    <p class="text-xs tracking-widest uppercase">
                        Connecting Global Cutting Edge Technology
                    </p>

                    <p class="text-sm leading-relaxed mt-6">
                        We have an unrelenting commitment to making sure that our advanced
                        solutions yield tangible business impact.
                    </p>
                </div>

                <!-- Column 3 -->
                <div class="space-y-6">
                    <!-- Icon -->
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M16 4l2-2M8 4L6 2" />
                    </svg>

                    <p class="text-sm font-semibold">03.</p>
                    <h3 class="text-2xl font-bold">SUPPORT 24/7</h3>
                    <p class="text-xs tracking-widest uppercase">
                        Support for Critical Issues 24/7
                    </p>

                    <p class="text-sm leading-relaxed mt-6">
                        YE covers the application and its surrounding environments. We will
                        set up a helpdesk and assign a PIC, who becomes the single support
                        contact point. Our team will provide proactive maintenance during
                        business days and on-call support for critical issues 24/7.
                    </p>
                </div>

            </div>
        </section>
    </div>
    <div class="relative isolate overflow-x-hidden">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-12 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:grid-cols-9 brand-logos-grid">
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/amazon-2.svg') }}"
                        alt="amazon  "
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/amazon-dark.svg') }}"
                        alt="amazon"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/angular.svg') }}" alt="angular"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/angular.svg') }}" alt="angular"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/yarn.svg') }}" alt="yarn"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/yarn.svg') }}" alt="yarn"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/bootstrap.svg') }}"
                        alt="bootstrap"
                        class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/bootstrap.svg') }}"
                        alt="bootstrap"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-2 lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/codeigniter.svg') }}"
                        alt="codeigniter"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/codeigniter.svg') }}"
                        alt="codeigniter"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-auto lg:col-span-1 brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/html.svg') }}" alt="html"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/html.svg') }}" alt="html"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/css.svg') }}" alt="css"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/css.svg') }}" alt="css"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/django.svg') }}" alt="django"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/django.svg') }}" alt="django"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/laravel.svg') }}" alt="laravel"
                        class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/laravel.svg') }}" alt="laravel"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-2 lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/go.svg') }}" alt="go"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/go.svg') }}" alt="go"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-auto lg:col-span-1 brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/microsoft-5.svg') }}"
                        alt="microsoft"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/microsoft-5.svg') }}"
                        alt="microsoft"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="   {{ asset('assets/media/brand-logos/nodejs.svg') }}"
                        alt="nodejs"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/nodejs.svg') }}" alt="nodejs"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/npm.svg') }}" alt="npm"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/npm.svg') }}" alt="npm"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/rails.svg') }}" alt="rails"
                        class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/rails.svg') }}" alt="rails"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-2 lg:col-span-1 brand-logo-item" />

                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/react.svg') }}" alt="react"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/react.svg') }}" alt="react"
                        class="col-span-2 col-start-2 max-h-12 w-full object-contain not-dark:hidden sm:col-start-auto lg:col-span-1 brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/vue.svg') }}" alt="vue"
                        class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:hidden brand-logo-item" />
                    <img width="158" height="48" src="{{ asset('assets/media/brand-logos/vue.svg') }}" alt="vue"
                        class="col-span-2 max-h-12 w-full object-contain not-dark:hidden lg:col-span-1 brand-logo-item" />
                </div>
            </div>
        </div>
    </div>
    <section class="mx-auto max-w-7xl relative isolate px-6 py-10 lg:py-14 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- LEFT SIDEBAR STICKY -->
            <aside class="col-span-1 lg:col-span-3">
                <div class="lg:sticky lg:top-32">
                    <h1
                        class="text-[40px] sm:text-[52px] leading-[0.95] font-black tracking-tight dark:text-white mb-6 lg:mb-10">
                        Services
                    </h1>

                    <div
                        class="sticky top-0 z-30 -mx-6 px-6 bg-gray-50/95 dark:bg-zinc-900/95 backdrop-blur border-b border-gray-200 dark:border-white/10 lg:static lg:bg-transparent lg:p-0 lg:border-none lg:mx-0">
                        <nav class="flex overflow-x-auto no-scrollbar space-x-6 py-3 lg:block lg:space-x-0 lg:space-y-2 lg:py-0"
                            id="svcNav">
                            <!-- items injected by JS -->
                        </nav>
                    </div>
                </div>
            </aside>

            <!-- RIGHT CONTENT (SCROLLABLE LIST) -->
            <section class="col-span-1 lg:col-span-9 space-y-32" id="svcList">
                <!-- All services injected here -->
            </section>
        </div>
    </section>
    <section
        class="max-w-7xl mx-auto relative isolate px-4 sm:px-6 py-10 overflow-x-hidden gsap-fade-up overflow-x-hidden">
        <div class="grid grid-cols-12 gap-6 md:gap-10 items-start">
            <!-- LEFT IMAGE CARD -->
            <aside class="col-span-12 md:col-span-5">
                <div class="relative overflow-hidden rounded-md min-w-0">
                    <!-- Replace this URL with your real image -->
                    <div class="h-[420px] w-full bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80');">
                    </div>

                    <!-- dark overlay -->
                    <div class="absolute inset-0 bg-black/35"></div>

                    <!-- Title -->
                    <div class="absolute left-4 sm:left-6 top-14 right-4 sm:right-10">
                        <h2
                            class="text-white font-extrabold leading-[1.05] text-2xl sm:text-3xl md:text-4xl break-words">
                            How to get started<br />
                            with the Service
                        </h2>
                    </div>

                    <!-- Blue callout box -->
                    <div
                        class="absolute left-4 sm:left-6 right-4 sm:right-6 bottom-6 bg-[var(--brand)] text-white p-4 sm:p-5">
                        <p class="text-[11px] leading-relaxed font-semibold break-words">
                            Our core competence is in web-based software and mobility.
                            Complemented with additional expertise on AI, Big Data, and IoT,
                            we can help you succeed. You can engage us on a project-based or
                            extended team manner to ensure fast innovation.
                        </p>
                    </div>
                </div>
            </aside>

            <!-- RIGHT STEPS -->
            <section class="col-span-12 md:col-span-7 min-w-0">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 sm:gap-x-10 gap-y-10">
                    <!-- 01 -->
                    <article>
                        <div class="text-[12px] font-extrabold text-slate-900 dark:text-slate-300">01.</div>
                        <h3 class="mt-1 text-[13px] font-extrabold text-[var(--brand)] break-words">
                            Aware of your Goals
                        </h3>
                        <p
                            class="mt-3 text-[12px] leading-6 text-slate-500 font-medium dark:text-slate-400 break-words">
                            We are eager to hear your story, what's keeping you up at night,
                            your ideas and vision, and how we can help. We will dig the
                            requirements.
                        </p>
                    </article>

                    <!-- 02 -->
                    <article>
                        <div class="text-[12px] font-extrabold text-slate-900 dark:text-slate-300">02.</div>
                        <h3 class="mt-1 text-[13px] font-extrabold text-[var(--brand)] break-words">
                            Expect a Proposal from Us
                        </h3>
                        <div
                            class="mt-3 space-y-4 text-[12px] leading-6 text-slate-500 font-medium dark:text-slate-400 break-words">
                            <p>
                                For development request, once the scope of work is understood
                                by both parties, we will estimate the effort and provide you
                                with a solution proposal with a fixed budget and deadline. Or,
                                if you prefer, we can do agile enhancement service with more
                                flexibility in the scope of work.
                            </p>
                            <p>
                                If you're looking for a managed service support for your
                                application, even if it's built by another software house we
                                can help you too. Once we inquire further and get a clearer
                                picture of your application, with the prerequisite
                                preparations completed we will send the service proposal too.
                            </p>
                        </div>
                    </article>

                    <!-- 03 -->
                    <article>
                        <div class="text-[12px] font-extrabold text-slate-900 dark:text-slate-300">03</div>
                        <h3 class="mt-1 text-[13px] font-extrabold text-[var(--brand)] break-words">
                            Enter a formal Contract
                        </h3>
                        <p
                            class="mt-3 text-[12px] leading-6 text-slate-500 font-medium dark:text-slate-400 break-words">
                            Once you conceptually agree, we sign a contract. Always know
                            you are in good hands. We have been here for 12 years and still
                            growing quickly, thus you can rest assured we can support you
                            long-term.
                        </p>
                    </article>

                    <!-- 04 -->
                    <article>
                        <div class="text-[12px] font-extrabold text-slate-900 dark:text-slate-300">04</div>
                        <h3 class="mt-1 text-[13px] font-extrabold text-[var(--brand)] break-words">
                            Implementation Starts
                        </h3>
                        <p
                            class="mt-3 text-[12px] leading-6 text-slate-500 font-medium dark:text-slate-400 break-words">
                            On project-based service by default YE will perform a
                            pre-development analysis, consistent progress demo, professional
                            change management practice, testing based on a thorough test plan
                            document – including security and performance tests, and guide
                            you through UAT. Ultimately, our proven processes mitigate risks
                            of delay and remove risks of project failure. You can get all of
                            that too with the agile enhancement, if you request for a complete
                            team.
                        </p>
                    </article>
                </div>

                <!-- Bottom button -->
                <div class="mt-10 flex justify-center bg-white dark:bg-black">
                    <a href="{{ route('web.contact') }}" wire:navigate
                        class="inline-flex items-center justify-center text-black dark:text-white rounded-sm bg-[var(--brand)] px-5 py-2 text-[12px] font-extrabold shadow-sm hover:opacity-95 break-words">
                        Ready to work with us
                    </a>
                </div>
            </section>
        </div>
    </section>

    {{-- <section class="grid grid-cols-12 gap-10 items-start overflow-x-hidden">
        <!-- LEFT CARD (image + title overlay + blue info box) -->
        <aside class="col-span-12 lg:col-span-5">
            <div class="relative overflow-hidden bg-slate-200">
                <!-- background image -->
                <!-- ganti src dengan gambar kamu sendiri -->
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=70"
                    alt="Team discussion" class="h-[520px] w-full object-cover" />

                <!-- dark overlay for title -->
                <div class="absolute inset-0 bg-black/55"></div>

                <!-- title (top-left) -->
                <div class="absolute left-10 top-16 max-w-[300px]">
                    <h2 class="text-white font-black leading-[1.05] text-[40px]">
                        How to get started<br />
                        with the Service
                    </h2>
                </div>

                <!-- blue info strip (bottom-left) -->
                <div class="absolute left-0 bottom-0 w-full">
                    <div class="bg-[var(--brand)] px-8 py-6 text-white">
                        <p class="text-[12px] leading-5 font-semibold max-w-[520px]">
                            Our core competence is in web-based software and mobility.
                            Complemented with additional expertise on AI, Big Data, and IoT,
                            we can help you succeed. You can engage us on a project-based or
                            extended team manner to ensure fast innovation.
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- RIGHT CONTENT (steps 2 columns) -->
        <section class="col-span-12 lg:col-span-7">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-14 gap-y-12">
                <!-- 01 -->
                <article>
                    <p class="text-[12px] font-extrabold tracking-widest text-slate-900">
                        01.
                    </p>
                    <h3 class="mt-2 text-[14px] font-extrabold text-[var(--brand)]">
                        Aware of your Goals
                    </h3>
                    <p class="mt-3 text-[12px] leading-5 text-slate-600 font-medium dark:text-slate-400">
                        We are eager to hear your story, what’s keeping you up at night,
                        your ideas and vision, and how we can help. We will dig the
                        requirements.
                    </p>
                </article>

                <!-- 02 -->
                <article>
                    <p class="text-[12px] font-extrabold tracking-widest text-slate-900">
                        02.
                    </p>
                    <h3 class="mt-2 text-[14px] font-extrabold text-[var(--brand)]">
                        Expect a Proposal from Us
                    </h3>
                    <div class="mt-3 space-y-3 text-[12px] leading-5 text-slate-600 font-medium dark:text-slate-400">
                        <p>
                            For development request, once the scope of work is understood by
                            both parties, we will estimate the effort and provide you with a
                            solution proposal with a fixed budget and deadline. Or, if you
                            prefer, we can do agile enhancement service with more flexibility
                            in the scope of work.
                        </p>
                        <p>
                            If you’re looking for a managed service support for your
                            application, even if it’s built by another software house we can
                            help you too. Once we inquire further and get a clearer picture
                            of your application, with the prerequisite preparations completed
                            we will send the service proposal to.
                        </p>
                    </div>
                </article>

                <!-- 03 -->
                <article>
                    <p class="text-[12px] font-extrabold tracking-widest text-slate-900">
                        03.
                    </p>
                    <h3 class="mt-2 text-[14px] font-extrabold text-[var(--brand)]">
                        Enter a formal Contract
                    </h3>
                    <p class="mt-3 text-[12px] leading-5 text-slate-600 font-medium dark:text-slate-400">
                        Once you conceptually agree, we sign a contract. Always know you
                        are in good hands. We have been here for 12 years and still
                        growing quickly, thus you can rest assured we can support you
                        long-term.
                    </p>
                </article>

                <!-- 04 -->
                <article>
                    <p class="text-[12px] font-extrabold tracking-widest text-slate-900">
                        04.
                    </p>
                    <h3 class="mt-2 text-[14px] font-extrabold text-[var(--brand)]">
                        Implementation Starts
                    </h3>
                    <p class="mt-3 text-[12px] leading-5 text-slate-600 font-medium">
                        On project-based service by default YE will perform a pre-development
                        analysis, consistent progress demo, professional change management
                        practice, testing based on a thorough test plan document — including
                        security and performance tests, and guide you through UAT. Ultimately,
                        our proven processes mitigate risks of delay and remove risks of
                        project failure. You can get all of that too with the agile
                        enhancement, if you request for a complete team.
                    </p>
                </article>
            </div>

            <!-- bottom button aligned like screenshot -->
            <div class="mt-14 flex justify-center">
                <a href="#"
                    class="inline-flex items-center justify-center bg-[var(--brand)] px-10 py-3 text-white font-extrabold text-[12px] rounded-md shadow-sm hover:opacity-90 transition">
                    Ready to work with us
                </a>
            </div>
        </section>
    </section> --}}
    <section class="max-w-7xl mx-auto relative isolate px-6 py-8 gsap-fade-up overflow-x-hidden">
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
    <section class="max-w-7xl mx-auto gsap-fade-down overflow-x-hidden">
        <livewire:web.solutions.workflow-agile />
    </section>
    <section class="max-w-7xl mx-auto relative isolate px-6 py-8 gsap-fade-up overflow-x-hidden">
        <!-- thin top line -->
        <div class="h-px w-full bg-slate-900/55"></div>

        <!-- title -->
        <h1 class="mt-6 text-[44px] leading-[0.95] font-black tracking-tight">
            Team<br />
            Relationship Model
        </h1>
    </section>
    <section class="max-w-7xl mx-auto gsap-fade-down overflow-x-hidden">
        <livewire:web.solutions.team-relationship />
    </section>
    <script>
        (function () {
            const ICONS = {
                ai: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M30 10a14 14 0 1 1-8-2" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M30 10h8v8" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `,
                agile: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M30 10a14 14 0 1 1-8-2" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M30 10h8v8" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `,
                project: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M14 6h18l6 6v30H14V6Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
            <path d="M32 6v10h10" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
          </svg>
        `,
                managed: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M24 16a8 8 0 1 0 0 16a8 8 0 0 0 0-16Z" stroke="currentColor" stroke-width="3"/>
            <path d="M24 6v6M24 36v6M6 24h6M36 24h6" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M11 11l4 4M33 33l4 4M37 11l-4 4M15 33l-4 4" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
          </svg>
        `,
                design: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M10 38h28" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M18 34V10h12v24" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
            <path d="M14 18h20" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M24 10V6" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
          </svg>
        `,
                writer: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M10 38h28" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M14 30l20-20l4 4l-20 20l-6 2l2-6Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
            <path d="M30 10l8 8" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
          </svg>
        `,
                qa: `
          <svg viewBox="0 0 48 48" fill="none">
            <path d="M24 6l16 6v12c0 10-6.5 16.5-16 18c-9.5-1.5-16-8-16-18V12l16-6Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
            <path d="M18 24l4 4l8-10" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `,
            };

            const SERVICES = [{
                key: "AI",
                nav: "AI Development",
                title: "AI<br/>DEVELOPMENT",
                desc: "AI development methodologies centered round the idea of iterative development",
                highlights: ["Machine Learning", "Deep Learning", "Computer Vision"],
                panelType: "twoCol",
                leftHead: "Machine Learning",
                rightHead: "Deep Learning",
                leftBullets: [
                    "Image Classification",
                    "Object Detection",
                    "Image Segmentation",
                ],
                rightBullets: ["Computer Vision", "Speech Recognition", "Image Segmentation"],
                href: "{{ route('web.solutions.ai-development') }}",
            },
            {
                key: "agile",
                nav: "Agile Development",
                title: "AGILE<br/>DEVELOPMENT",
                desc: "Software development methodologies centered round the idea of iterative development",
                highlights: ["FLEXIBLE SCOPE", "SPRINT BASED", "FULL SQUAD"],
                panelType: "twoCol",
                leftHead: "EXTENDED",
                rightHead: "FULL SQUAD",
                leftBullets: [
                    "Ensured Project Continuity",
                    "Technical Support",
                    "Best-Practice Software Engineering",
                ],
                rightBullets: ["TRIBE", "SQUAD", "CHAPTER"],
                href: "{{ route('web.solutions.agile-development') }}",
            },
            {
                key: "project",
                nav: "Project Based",
                title: "PROJECT<br/>BASED",
                desc: "Consult Your Project Development. Build all kind of custom made apps.",
                highlights: ["CUSTOM MADE APP", "FIXED BUDGET DELIVERY", "FULL SQUAD"],
                panelType: "oneCol",
                head: "ADVANTAGES",
                bullets: [
                    "Ensured Project Continuity",
                    "Technical Support",
                    "Best-Practice Software Engineering",
                ],
                href: "{{ route('web.solutions.project-based') }}",
            },
            {
                key: "managed",
                nav: "Managed Services",
                title: "MANAGED<br/>SERVICES",
                desc: "Run Your Application with Peace of Mind. Our Developer will maintain your application professionally.",
                highlights: ["PROACTIVE SUPPORT", "SLA TO MEET", "INTERACTIVE HELPDESK"],
                panelType: "oneCol",
                head: "ADVANTAGES",
                bullets: [
                    "Ensured Project Continuity",
                    "Technical Support",
                    "Best-Practice Software Engineering",
                ],
                href: "{{ route('web.solutions.managed-services') }}",
            },
            {
                key: "design",
                nav: "Design Services",
                title: "DESIGN<br/>SERVICES",
                desc: "Build product with a clear design process and delivers a spot-on end result.",
                highlights: [
                    "QUALIFIED AND EXPERIENCE DESIGNER",
                    "DESIGN THINKING",
                    "IMPROVE USABILITY",
                ],
                panelType: "oneCol",
                head: "ADVANTAGES",
                bullets: [
                    "Qualified and Experience Designer",
                    "Striking Design",
                    "Client Centric Design Services",
                    "Improve Usability",
                ],
                href: "{{ route('web.solutions.design-services') }}",
            },
            {
                key: "writer",
                nav: "Technical Writer",
                title: "TECHNICAL<br/>WRITER",
                desc: "Improve your business or operation with software blueprint tailored for your company as a basis of system development.",
                highlights: [
                    "SYSTEM BUSINESS PROVEN EXPERTISE",
                    "SAVE COST",
                    "BUSINESS ROADMAP GOALS",
                ],
                panelType: "oneCol",
                head: "ADVANTAGES",
                bullets: [
                    "Have insights on system / business operation with proven expertise and experience",
                    "Full Control of System Development",
                    "Creating Roadmap for system development based on Business Priorities and Goals",
                ],
                href: "{{ route('web.solutions.technical-writer') }}",
            },
            {
                key: "qa",
                nav: "Quality Assurance",
                title: "QUALITY<br/>ASSURANCE",
                desc: "Improve the apps quality through professional testing services.",
                highlights: ["YE STANDARD VALIDATION", "TRACEABILITY MATRIX", "CAPABLE TESTER"],
                panelType: "oneCol",
                head: "ADVANTAGES",
                bullets: [
                    "Best-Practice Testing Methods and Techniques",
                    "Provide dedicated and experienced tester",
                    "Tester think out of the box to found the bug",
                    "Tester give you idea or suggestions that improve your quality software",
                ],
                href: "{{ route('web.solutions.quality-assurance') }}",
            },
            
            ];

            const navEl = document.getElementById("svcNav");
            const listEl = document.getElementById("svcList");

            function arrowIcon() {
                return `
          <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" aria-hidden="true">
            <path d="M7 17L17 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M9 7h8v8" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `;
            }

            // function panelButton(svc) {
            //     return `
            //   <div class="mt-10 flex justify-center">
            //     <a
            //       href="${svc.href}"
            //       class="inline-flex items-center gap-3 border border-[var(--brand)] px-10 py-4 font-extrabold text-[var(--brand)] hover:bg-[var(--brand)] hover:text-white transition"
            //     >
            //       Learn More
            //       ${arrowIcon()}
            //     </a>
            //   </div>
            // `;
            // }

            function renderPanel(svc) {
                if (svc.panelType === "twoCol") {
                    return `
            <div class="grid grid-cols-1 gap-8">
              <div class="grid grid-cols-2 gap-10">
                <div>
                  <div class="text-[12px] font-extrabold tracking-[0.3em] text-[var(--brand)]">
                    ${svc.leftHead}
                  </div>
                  <div class="mt-4 border-b border-slate-600/60"></div>
                  <ul class="mt-5 space-y-4 text-[14px] font-bold text-slate-900 dark:text-slate-200">
                    ${svc.leftBullets
                            .map(
                                (b) => `
                                                            <li class="flex items-start gap-3">
                                                                <span class="mt-[7px] h-[5px] w-[5px] rounded-full bg-slate-900 dark:bg-slate-200"></span>
                                                                <span>${b}</span>
                                                            </li>`
                            )
                            .join("")}
                  </ul>
                </div>

                <div>
                  <div class="text-[12px] font-extrabold tracking-[0.3em] text-[var(--brand)]">
                    ${svc.rightHead}
                  </div>
                  <div class="mt-4 border-b border-slate-600/60"></div>
                  <ul class="mt-5 space-y-4 text-[14px] font-extrabold text-[var(--brand)] uppercase">
                    ${svc.rightBullets
                            .map(
                                (b) => `
                                                            <li class="flex items-start gap-3">
                                                                <span class="mt-[7px] h-[5px] w-[5px] rounded-full bg-[var(--brand)]"></span>
                                                                <span>${b}</span>
                                                            </li>`
                            )
                            .join("")}
                  </ul>
                </div>
              </div>

                        <div class="mt-10 flex justify-center">
            <a
              href="${svc.href}"
              wire:navigate
              class="inline-flex items-center gap-3 border border-[var(--brand)] px-10 py-4 font-extrabold text-[var(--brand)] hover:bg-[var(--brand)] hover:text-white transition"
            >
              Learn More
              ${arrowIcon()}
            </a>
          </div>
            </div>
          `;
                }

                // one column
                return `
          <div>
            <div class="text-[12px] font-extrabold tracking-[0.3em] text-[var(--brand)]">
              ${svc.head}
            </div>
            <div class="mt-4 border-b border-slate-600/60"></div>

            <ul class="mt-6 space-y-4 text-[14px] font-bold text-slate-900 dark:text-slate-200">
              ${svc.bullets
                        .map(
                            (b) => `
                                                   <li class="flex items-start gap-3">
                                                       <span class="mt-[7px] h-[5px] w-[5px] rounded-full bg-slate-900 dark:bg-slate-200"></span>
                                                       <span>${b}</span>
                                                   </li>`
                        )
                        .join("")}
            </ul>

                      <div class="mt-10 flex justify-center">
            <a
              href="${svc.href}"
              wire:navigate
              class="inline-flex items-center gap-3 border border-[var(--brand)] px-10 py-4 font-extrabold text-[var(--brand)] hover:bg-[var(--brand)] hover:text-white transition"
            >
              Learn More
              ${arrowIcon()}
            </a>
          </div>
          </div>
        `;
            }

            // 1. Render Sticky Navigation
            function renderNav() {
                navEl.innerHTML = SERVICES.map((s) => {
                    return `
            <a
              href="#svc-${s.key}"
              data-target="svc-${s.key}"
              class="nav-item flex-shrink-0 flex items-center gap-3 py-2 border-b-2 border-transparent transition-all lg:w-full lg:text-left lg:border-b-0 lg:border-none group"
            >
              <span class="indicator hidden lg:block h-3 w-3 bg-slate-200 transition-colors group-[.active]:bg-[var(--brand)]"></span>
              <span class="label text-sm font-bold text-slate-400 whitespace-nowrap lg:text-[16px] lg:text-slate-300 lg:font-extrabold transition-colors group-[.active]:text-[var(--brand)] lg:group-[.active]:text-slate-900 lg:group-hover:text-slate-500 dark:lg:group-[.active]:text-white dark:lg:group-hover:text-slate-200"
                style="letter-spacing: 0.02em;"
              >
                ${s.nav}
              </span>
            </a>
          `;
                }).join("");
            }

            // 2. Render All Services in Vertical List
            function renderServices() {
                listEl.innerHTML = SERVICES.map((svc) => {
                    const highlightsHTML = svc.highlights
                        .map(
                            (h) => `
                <li class="flex items-center gap-3">
                    <span class="h-[6px] w-[6px] bg-[var(--brand)]"></span>
                    <span>${h}</span>
                </li>`
                        )
                        .join("");

                    return `
        <article id="svc-${svc.key}" class="service-block scroll-mt-32 grid grid-cols-1 gap-6 lg:grid-cols-12 lg:gap-10 overflow-x-hidden">
            <!-- Service Content (Title, Highlights) -->
            <div class="lg:col-span-12 xl:col-span-5">
                <div class="flex items-start gap-4 flex-wrap">
                    <div class="mt-1 h-11 w-11 text-[var(--brand)]" aria-hidden="true">
                        ${ICONS[svc.key] || ""}
                    </div>
                    <h2 class="text-[40px] sm:text-[48px] md:text-[54px] leading-[1.1] font-black tracking-tight uppercase dark:text-white break-words">
                        ${svc.title}
                    </h2>
                </div>

                <p class="ml-0 sm:ml-[20px] mt-4 text-[16px] leading-7 text-slate-600 dark:text-slate-400 break-words">
                    ${svc.desc}
                </p>

                <ul class="mt-6 space-y-3 text-[14px] font-extrabold tracking-widest uppercase text-[var(--brand)]">
                    ${highlightsHTML}
                </ul>
                <div class="mt-6 border-b border-slate-800/60 lg:hidden"></div>
            </div>

            <!-- Right Panel (Advantages / Details) -->
            <aside class="lg:col-span-12 xl:col-span-7 flex flex-col">
                <div class="bg-[var(--panel)] p-6 sm:p-8 lg:p-10 border border-slate-200 flex-1 min-w-0 overflow-x-auto">
                    ${renderPanel(svc)}
                </div>
            </aside>
        </article>
        <div class="hidden lg:block border-b border-slate-200 last:hidden"></div>
        `;
                }).join("");
            }


            // 3. Setup Scroll Spy (Intersection Observer)
            function setupScrollSpy() {
                const navItems = document.querySelectorAll(".nav-item");
                const sections = document.querySelectorAll(".service-block");

                const observerOptions = {
                    root: null,
                    // Adjust rootMargin to trigger active state a bit before the section hits the exact top
                    rootMargin: "-20% 0px -60% 0px",
                    threshold: 0
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            // Remove active from all
                            navItems.forEach((n) => n.classList.remove("active"));

                            // Add active to current
                            const id = entry.target.getAttribute("id");
                            const activeNav = document.querySelector(`.nav-item[data-target="${id}"]`);
                            if (activeNav) {
                                activeNav.classList.add("active");
                            }
                        }
                    });
                }, observerOptions);

                sections.forEach((section) => {
                    observer.observe(section);
                });
            }

            // Initial Render
            renderNav();
            renderServices();

            // Use setTimeout to ensure DOM is fully painted before observer kicks in (optional but safe)
            setTimeout(() => {
                setupScrollSpy();
                // Set first item active initially if needed
                const firstNav = document.querySelector(".nav-item");
                if (firstNav) firstNav.classList.add("active");
            }, 100);

            // Expose init function globally for Livewire navigation
            window.initSolutionsServices = function () {
                renderNav();
                renderServices();
                setTimeout(() => {
                    setupScrollSpy();
                    const firstNav = document.querySelector(".nav-item");
                    if (firstNav) firstNav.classList.add("active");
                }, 100);
            };
        })(); // End IIFE
    </script>
    <script>
        // Ensure GSAP + ScrollTrigger are available (CDN fallback)
        function ensureGsap(callback) {
            if (window.gsap && window.ScrollTrigger) {
                return callback();
            }

            const loadScript = (src) => new Promise((resolve, reject) => {
                const s = document.createElement('script');
                s.src = src;
                s.async = true;
                s.onload = resolve;
                s.onerror = reject;
                document.head.appendChild(s);
            });

            (async () => {
                try {
                    if (!window.gsap) {
                        await loadScript('https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js');
                    }
                    if (!window.ScrollTrigger) {
                        await loadScript('https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js');
                    }
                } catch (e) {
                    console.warn('Failed to load GSAP from CDN:', e);
                } finally {
                    callback();
                }
            })();
        }

        // ==============================
        // SPLIT TEXT FUNCTION (FREE)
        // ==============================
        function splitTextToSpans(selector) {
            document.querySelectorAll(selector).forEach(el => {
                if (el.dataset.split === "true") return;

                const text = el.innerText;
                el.innerHTML = "";

                const words = text.split(" ");

                words.forEach((word, wIndex) => {
                    const wordSpan = document.createElement("span");
                    wordSpan.style.display = "inline-block";
                    wordSpan.style.whiteSpace = "nowrap";

                    const letters = word.split("");

                    letters.forEach(letter => {
                        const span = document.createElement("span");
                        span.innerText = letter;
                        span.style.display = "inline-block";
                        span.classList.add("split-char");
                        wordSpan.appendChild(span);
                    });

                    el.appendChild(wordSpan);

                    if (wIndex < words.length - 1) {
                        el.appendChild(document.createTextNode(" "));
                    }
                });

                el.dataset.split = "true";
            });
        }

        function initGsap() {
            ensureGsap(() => {
                try {
                    gsap.registerPlugin(ScrollTrigger);

                    // Kill old triggers (important for SPA / Livewire)
                    ScrollTrigger.getAll().forEach(t => t.kill());

                    // ==============================
                    // PREPARE SPLIT TEXT
                    // ==============================
                    splitTextToSpans(".split-text");
                    splitTextToSpans(".split-text-desc");

                    // ==============================
                    // Fade Left
                    // ==============================
                    gsap.utils.toArray(".gsap-fade-left").forEach((el) => {
                        gsap.fromTo(el, {
                            opacity: 0,
                            x: -80
                        }, {
                            opacity: 1,
                            x: 0,
                            duration: 1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                end: "bottom 20%",
                                toggleActions: "play reverse play reverse"
                            }
                        });
                    });

                    // ==============================
                    // Fade Right
                    // ==============================
                    gsap.utils.toArray(".gsap-fade-right").forEach(el => {
                        gsap.fromTo(el, {
                            x: 80,
                            opacity: 0
                        }, {
                            x: 0,
                            opacity: 1,
                            duration: 1.1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                end: "bottom 20%",
                                toggleActions: "play reverse play reverse"
                            }
                        });
                    });

                    // ==============================
                    // Fade Up
                    // ==============================
                    gsap.utils.toArray(".gsap-fade-up").forEach(el => {
                        gsap.fromTo(el, {
                            y: 60,
                            opacity: 0
                        }, {
                            y: 0,
                            opacity: 1,
                            duration: 1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                end: "bottom 20%",
                                toggleActions: "play reverse play reverse"
                            }
                        });
                    });

                    // ==============================
                    // Fade Down
                    // ==============================
                    gsap.utils.toArray(".gsap-fade-down").forEach(el => {
                        gsap.fromTo(el, {
                            y: -60,
                            opacity: 0
                        }, {
                            y: 0,
                            opacity: 1,
                            duration: 1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                end: "bottom 20%",
                                toggleActions: "play reverse play reverse"
                            }
                        });
                    });

                    // ==============================
                    // Stagger Blog List
                    // ==============================
                    gsap.utils.toArray(".blog-list").forEach(list => {
                        const items = list.querySelectorAll(".blog-item");

                        gsap.fromTo(items, {
                            y: 50,
                            opacity: 0
                        }, {
                            y: 0,
                            opacity: 1,
                            duration: 0.8,
                            ease: "power3.out",
                            stagger: 0.15,
                            scrollTrigger: {
                                trigger: list,
                                start: "top 80%",
                            }
                        });
                    });

                    // ==============================
                    // Parallax Image
                    // ==============================
                    gsap.utils.toArray(".gsap-parallax").forEach(img => {
                        gsap.to(img, {
                            y: -80,
                            ease: "none",
                            scrollTrigger: {
                                trigger: img,
                                start: "top bottom",
                                end: "bottom top",
                                scrub: true
                            }
                        });
                    });

                    // ==============================
                    // SPLIT TEXT ANIMATION (NEW)
                    // ==============================
                    gsap.utils.toArray(".split-text").forEach(el => {
                        const chars = el.querySelectorAll(".split-char");

                        gsap.fromTo(chars, {
                            y: 60,
                            opacity: 0,
                            rotateX: 90
                        }, {
                            y: 0,
                            opacity: 1,
                            rotateX: 0,
                            duration: 0.8,
                            ease: "power3.out",
                            stagger: 0.02,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            }
                        });
                    });
                    gsap.utils.toArray(".split-text-desc").forEach(el => {
                        const chars = el.querySelectorAll(".split-char");

                        gsap.fromTo(chars, {
                            y: 60,
                            opacity: 0,
                            rotateX: 90
                        }, {
                            y: 0,
                            opacity: 1,
                            rotateX: 0,
                            duration: 0.1,
                            ease: "power3.out",
                            stagger: 0.005,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            }
                        });
                    });

                } catch (err) {
                    console.error('GSAP init error:', err);
                }
            });
        }

        // ==============================
        // Run on load
        // ==============================
        document.addEventListener("DOMContentLoaded", () => {
            initGsap();
        });

        // ==============================
        // If using Livewire / SPA / Turbo
        // ==============================
        document.addEventListener("livewire:navigated", () => {
            setTimeout(() => initGsap(), 50);
        });

        document.addEventListener("turbo:load", () => {
            setTimeout(() => initGsap(), 50);
        });

        // ==============================
        // Fallback
        // ==============================
        if (document.readyState !== 'loading') {
            initGsap();
        }

        // ==============================
        // APPLY RANDOM GSAP ANIMATIONS TO BRAND LOGOS
        // ==============================
        function applyRandomAnimationsToLogos() {
            const animationTypes = ['gsap-fade-up', 'gsap-fade-down', 'gsap-fade-left', 'gsap-fade-right'];
            const logos = document.querySelectorAll('.brand-logo-item');

            logos.forEach((logo, index) => {
                // Assign random animation class
                const randomAnimation = animationTypes[Math.floor(Math.random() * animationTypes.length)];
                logo.classList.add(randomAnimation);
            });
        }

        // Apply random animations setelah DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    applyRandomAnimationsToLogos();
                    initGsap();
                }, 100);
            });
        } else {
            setTimeout(() => {
                applyRandomAnimationsToLogos();
            }, 100);
        }

        // Apply when Livewire navigates
        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                applyRandomAnimationsToLogos();

                // Re-render services and nav
                if (typeof window.initSolutionsServices === 'function') {
                    window.initSolutionsServices();
                }

                initGsap();
            }, 100);
        });
    </script>
</x-layouts.web>