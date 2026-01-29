<?php
use App\Models\CMS\Post;
use function Livewire\Volt\computed;

$posts = computed(fn() => Post::take(3)->orderBy('id', 'desc')->get());

?>
<div id="insights" class="relative isolate border-t border-gray-200/60 dark:border-white/10" aria-labelledby="insights-title">
    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-xs font-semibold tracking-[0.22em] text-indigo-600 dark:text-indigo-400">Insights</p>
                <h2 id="insights-title"
                    class="mt-2 text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">
                    What’s new at YE
                </h2>
                <p class="mt-4 text-base/7 text-gray-600 dark:text-gray-300">
                    Updates from delivery, product, and field work — so you can see how we build and ship.
                </p>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 blog-list">
                @foreach ($this->posts as $post)
                <article data-blog-card
                         class="blog-item relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pt-80 pb-8 sm:pt-48 lg:pt-80 dark:bg-gray-800">
                    <img src="{{ asset('storage/' . ($post->featured_image ?? 'images/default.jpg')) }}" alt="Workshop presentation" loading="lazy" decoding="async"
                         class="absolute inset-0 -z-10 size-full object-cover" />
                    <div
                        class="absolute inset-0 -z-10 bg-linear-to-t from-gray-900 via-gray-900/40 dark:from-black/80 dark:via-black/40">
                    </div>
                    <div
                        class="absolute inset-0 -z-10 rounded-2xl inset-ring inset-ring-gray-900/10 dark:inset-ring-white/10">
                    </div>

                    <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
                        <time datetime="2021-12-17" class="mr-8">{{ $post->created_at->format('F j, Y') }}</time>
                        <div class="-ml-4 flex items-center gap-x-4">
                            <svg viewBox="0 0 2 2" class="-ml-0.5 size-0.5 flex-none fill-white/50 dark:fill-gray-300/50">
                                <circle r="1" cx="1" cy="1" />
                            </svg>
                            <div class="flex gap-x-2.5">
                                <img src="{{ asset('assets/media/team/lygiad.jpeg') }}" alt="Lygia" loading="lazy" decoding="async"
                                     class="size-6 flex-none rounded-full bg-white/10 dark:bg-gray-800/10" />
                                Lygia
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 text-lg/6 font-semibold text-white">
                        <a href="{{ route('web.blogs') }}" wire:navigate>
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
