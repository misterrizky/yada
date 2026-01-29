<?php
use App\Models\CMS\Post;
use function Livewire\Volt\computed;

$posts = computed(fn() => Post::all());

?>
<div class="bg-white py-24 sm:py-32 dark:bg-black overflow-x-hidden">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">From the blog</h2>
            <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">Learn how to grow your business with our expert advice.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            @foreach ($this->posts as $blog)
            <article class="flex flex-col items-start justify-between gsap-fade-left product-item">
                <div class="relative w-full">
                    <img src="{{ asset('storage/' . ($blog->featured_image ?? 'images/default.jpg')) }}" alt="" class="aspect-video w-full rounded-2xl bg-gray-100 object-cover sm:aspect-2/1 lg:aspect-3/2 dark:bg-gray-800" />
                    <div class="absolute inset-0 rounded-2xl inset-ring inset-ring-gray-900/10 dark:inset-ring-white/10"></div>
                </div>
                <div class="flex max-w-xl grow flex-col justify-between">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        {{-- <time datetime="2020-03-16" class="text-gray-500 dark:text-gray-400">Mar 16, 2020</time>--}}
                        {{-- <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100 dark:bg-gray-800/60 dark:text-gray-300 dark:hover:bg-gray-800">Industry Analysis</a> --}}
                    </div>
                    <div class="group relative grow">
                        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                            <a href="{{ route('web.blogs.show', ['post' => $blog]) }}" wire:navigate>
                                <span class="absolute inset-0"></span>
                                {{ $blog->title }}
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">{{ $blog->content }}</p>
                    </div>
                    <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                        {{-- <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full bg-gray-100 dark:bg-gray-800" />--}}
                        <div class="text-sm/6">
                            <p class="font-semibold text-gray-900 dark:text-white">
                                <a href="{{ route('web.about') }}#team" wire:navigate>
                                    <span class="absolute inset-0"></span>
                                    Ryandra Gunawan
                                </a>
                            </p>
                            {{-- <p class="text-gray-600 dark:text-gray-400">Co-Founder / CTO</p>--}}
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
         <nav class="mt-12 flex items-center justify-between border-t border-white/10 pt-4">
                <button id="prevBtn" class="text-gray-400 hover:text-white">
                    ← Previous
                </button>

                <div id="pageNumbers" class="hidden md:flex gap-2"></div>

                <button id="nextBtn" class="text-gray-400 hover:text-white">
                    Next →
                </button>
            </nav>
    </div>
</div>
<script>
/* ==============================
   PAGINATION
================================ */
function initPagination() {
    const items = document.querySelectorAll('.product-item');
    if (!items.length) return;

    const itemsPerPage = 12;
    let currentPage = 1;

    const totalPages = Math.ceil(items.length / itemsPerPage);
    const pageNumbers = document.getElementById('pageNumbers');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (!pageNumbers || !prevBtn || !nextBtn) return;

    function showPage(page) {
        currentPage = page;

        items.forEach((item, index) => {
            item.style.display =
                index >= (page - 1) * itemsPerPage &&
                index < page * itemsPerPage
                    ? 'flex'
                    : 'none';
        });

        renderNumbers();

        // 🔥 penting buat GSAP
        ScrollTrigger?.refresh();
    }

    function renderNumbers() {
        pageNumbers.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className =
                `px-3 pt-2 text-sm border-t-2 ${
                    i === currentPage
                        ? 'border-indigo-400 text-indigo-400'
                        : 'border-transparent text-gray-400 hover:text-white'
                }`;
            btn.onclick = () => showPage(i);
            pageNumbers.appendChild(btn);
        }
    }

    prevBtn.onclick = () => currentPage > 1 && showPage(currentPage - 1);
    nextBtn.onclick = () => currentPage < totalPages && showPage(currentPage + 1);

    showPage(1);
}

/* ==============================
   GSAP LOADER
================================ */
function ensureGsap(callback) {
    if (window.gsap && window.ScrollTrigger) {
        return callback();
    }

    const loadScript = (src) =>
        new Promise((resolve, reject) => {
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
            console.warn('GSAP load failed:', e);
        } finally {
            callback();
        }
    })();
}

/* ==============================
   GSAP INIT
================================ */
function initGsap() {
    ensureGsap(() => {
        try {
            gsap.registerPlugin(ScrollTrigger);

            // clear old triggers (Livewire safe)
            ScrollTrigger.getAll().forEach(t => t.kill());

            gsap.utils.toArray(".gsap-fade-left").forEach(el => {
                gsap.fromTo(el,
                    { opacity: 0, x: -80 },
                    {
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
                    }
                );
            });

            gsap.utils.toArray(".gsap-fade-right").forEach(el => {
                gsap.fromTo(el,
                    { opacity: 0, x: 80 },
                    {
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
                    }
                );
            });

            gsap.utils.toArray(".gsap-fade-up").forEach(el => {
                gsap.fromTo(el,
                    { opacity: 0, y: 60 },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: el,
                            start: "top 85%",
                            end: "bottom 20%",
                            toggleActions: "play reverse play reverse"
                        }
                    }
                );
            });

            gsap.utils.toArray(".gsap-fade-down").forEach(el => {
                gsap.fromTo(el,
                    { opacity: 0, y: -60 },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: el,
                            start: "top 85%",
                            end: "bottom 20%",
                            toggleActions: "play reverse play reverse"
                        }
                    }
                );
            });

        } catch (err) {
            console.error('GSAP init error:', err);
        }
    });
}

/* ==============================
   RUNNERS
================================ */
function initAll() {
    initPagination();
    initGsap();
}

// first load
document.addEventListener('DOMContentLoaded', initAll);

// Livewire SPA
document.addEventListener('livewire:navigated', () => {
    setTimeout(initAll, 50);
});

// Turbo
document.addEventListener('turbo:load', () => {
    setTimeout(initAll, 50);
});
</script>
