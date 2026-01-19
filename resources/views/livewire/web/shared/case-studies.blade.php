    <div class="relative isolate">
        <section class="relative overflow-hidden py-14">
            <!-- BACKGROUND LAYER (putih atas, biru bawah) -->
            <div class="absolute inset-0 -z-10">
                <!-- putih -->
                <div class="absolute inset-0 bg-white"></div>

                <!-- biru (tinggi bisa kamu atur) -->
                <div class="absolute inset-x-0 bottom-0 h-[77%] bg-[#0837E8]"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-[420px_1fr] lg:items-center">

                    <!-- LEFT CONTENT -->
                    <div class="text-white lg:pt-10">
                        <p class="text-sm font-semibold tracking-[0.25em] opacity-90">
                            CASE STUDIES
                        </p>

                        <div class="mt-4 h-[2px] w-[260px] bg-white/60"></div>

                        <h2 class="mt-6 text-5xl font-extrabold leading-tight">
                            Featured Project
                        </h2>

                        <a href="#"
                            class="mt-10 inline-flex items-center justify-center border border-white/70 px-7 py-3 text-sm font-semibold text-white hover:bg-white hover:text-[#0837E8] transition">
                            See more Case Studies
                        </a>
                    </div>

                    <!-- RIGHT SLIDER AREA -->
                    <div class="relative">
                        <!-- Left Arrow -->
                        <button id="prevBtn"
                            class="absolute left-[-30px] top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-black shadow hover:bg-gray-100 transition"
                            aria-label="Prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M15.78 4.22a.75.75 0 010 1.06L9.06 12l6.72 6.72a.75.75 0 11-1.06 1.06l-7.25-7.25a.75.75 0 010-1.06l7.25-7.25a.75.75 0 011.06 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Right Arrow -->
                        <button id="nextBtn"
                            class="absolute right-[-20px] top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-black shadow hover:bg-gray-100 transition"
                            aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M8.22 19.78a.75.75 0 010-1.06L14.94 12 8.22 5.28a.75.75 0 011.06-1.06l7.25 7.25a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Cards Container -->
                        <div class="overflow-hidden max-w-[900px]">
                            <div id="sliderTrack" class="flex gap-6 transition-transform duration-500 ease-out">
                                <!-- CARD 1 -->
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>
                                <a href="#" class="group relative w-[370px] shrink-0 overflow-hidden bg-black">
                                    <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=1400&auto=format&fit=crop"
                                        alt="Project 1" class="h-[430px] w-full object-cover opacity-80" />

                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/70">
                                    </div>

                                    <div class="absolute inset-0 p-8 text-white">
                                        <p class="text-xs font-bold tracking-widest opacity-90">INDUSTRIES</p>
                                        <p class="mt-2 text-lg font-extrabold">Banking &amp; Finance</p>

                                        <h3 class="mt-10 text-3xl font-extrabold leading-snug">
                                            Manulife's Internal<br />
                                            BPM / Workflow<br />
                                            Implementation
                                        </h3>
                                    </div>

                                    <!-- Read More Button -->
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full bg-[#0837E8] px-8 py-5 text-white transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="flex items-center justify-end gap-2 font-semibold">
                                            Read More
                                            <span class="text-lg">↗</span>
                                        </div>
                                    </div>

                                    <!-- Corner Cut -->
                                    <div
                                        class="absolute bottom-0 left-0 h-14 w-14 bg-[#0837E8] [clip-path:polygon(0_100%,0_0,100%_100%)]">
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        const sliderTrack = document.getElementById('sliderTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;
        const cardWidth = 370;
        const peekWidth = 130;
        const gap = 24; // gap-6 = 1.5rem = 24px
        const slideDistance = cardWidth + gap;
        const totalCards = sliderTrack.children.length;
        const maxIndex = totalCards - 2; // Because we show 2 full + 1 peek

        function updateSlider() {
            const translateX = -(currentIndex * slideDistance);
            sliderTrack.style.transform = `translateX(${translateX}px)`;

            // Disable buttons at boundaries
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;

            prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';

            prevBtn.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
            nextBtn.style.cursor = currentIndex >= maxIndex ? 'not-allowed' : 'pointer';
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        // Initialize
        updateSlider();
    </script>
