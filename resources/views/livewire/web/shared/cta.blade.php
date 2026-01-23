<div id="cta" class="relative isolate overflow-hidden bg-white dark:bg-black border-b border-gray-200/60 dark:border-white/10" aria-labelledby="cta-title">
    <div class="mx-auto max-w-7xl px-6 py-20 sm:py-28 lg:flex lg:items-center lg:justify-between lg:px-8">
        <div class="max-w-2xl">
            <p class="text-xs font-semibold tracking-[0.22em] text-indigo-600 dark:text-indigo-400">
                Get in touch
            </p>
            <h2 id="cta-title" class="mt-3 text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">
                What can we do to help you?
            </h2>
            <p class="mt-4 max-w-xl text-base/7 text-gray-600 dark:text-gray-300">
                Tell us your goals, timeline, and constraints. We’ll recommend the fastest path to value.
            </p>
        </div>

        <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center lg:mt-0">
            <a href="{{ route('web.contact') }}" wire:navigate class="yex-btn yex-btn-primary yex-magnetic">
                Contact us
            </a>
            <a href="{{ route('web.about') }}" wire:navigate class="yex-btn yex-btn-ghost yex-magnetic">
                Learn more <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</div>
