<div id="hero" class="relative isolate" aria-labelledby="hero-title">
    <div class="mx-auto max-w-7xl">
        <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true"
                 class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block dark:fill-black">
                <polygon points="0,0 90,0 50,100 0,100" />
            </svg>

            <div class="relative px-6 py-20 sm:py-28 lg:px-8 lg:py-10 lg:pr-0">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                    <p class="text-xs font-semibold tracking-[0.22em] text-indigo-600 dark:text-indigo-400">
                        YE — Software, AI, QA & Cloud
                    </p>

                    <h1
                        class="mt-4 text-3xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl lg:text-6xl dark:text-white split-text"
                        id="hero-title">
                        Transforming Ideas into Impactful Digital Solutions
                    </h1>

                    <p class="mt-6 text-base font-medium text-pretty text-gray-600 sm:text-lg dark:text-gray-300 split-text-desc">
                        Consulting, development, and end-to-end digital transformation for public sector, enterprise, and global teams.
                    </p>

                    <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-x-6">
                        <a href="{{ route('web.contact') }}" wire:navigate
                           class="yex-btn yex-btn-primary yex-magnetic w-full sm:w-auto">
                            Project consultation
                        </a>

                        <a href="{{ route('web.about') }}" wire:navigate
                           class="yex-btn yex-btn-ghost yex-magnetic w-full sm:w-auto">
                            Portfolio overview <span aria-hidden="true">→</span>
                        </a>
                    </div>

                    <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        Response within 1–2 business days. No spam.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-black lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 gsap-fade-down">
        <img
            src="https://images.unsplash.com/photo-1483389127117-b6a2102724ae?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1587&q=80"
            alt="Team collaborating on a digital product"
            class="aspect-3/2 object-cover lg:aspect-auto lg:size-full"
            loading="eager" decoding="async" fetchpriority="high" />
    </div>
</div>
