<!-- ========================= -->
<!-- DESKTOP (>= lg): 1920 wide -->
<!-- ========================= -->
<section class="hidden lg:block w-full">
    <div class="w-full overflow-x-hidden">
        <!-- 1920 canvas -->
        <svg viewBox="0 0 1920 900" class="w-full h-auto" aria-label="AI consulting process diagram (desktop)">
            <defs>
                <linearGradient id="rib" x1="0" y1="0" x2="1920" y2="0"
                    gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#F8FAFF" />
                    <stop offset="0.55" stop-color="#EEF1FF" />
                    <stop offset="1" stop-color="#E7EAF8" />
                </linearGradient>

                <filter id="softBlur" x="-40%" y="-40%" width="180%" height="180%">
                    <feGaussianBlur stdDeviation="10" />
                </filter>

                <marker id="mArrow" markerWidth="10" markerHeight="10" refX="9" refY="5"
                    orient="auto">
                    <path d="M0,0 L10,5 L0,10 Z" fill="#B8B8B8" />
                </marker>

                <style>
                    .dash {
                        stroke: #b8b8b8;
                        stroke-width: 4;
                        stroke-dasharray: 10 10;
                        opacity: 0.9;
                    }

                    .step {
                        fill: #0b2ce8;
                        font-weight: 800;
                    }

                    .title {
                        fill: #5b5b63;
                        font-weight: 900;
                    }

                    .desc {
                        fill: #8a8a94;
                        font-weight: 700;
                    }
                </style>
            </defs>

            <!-- Background -->
            <rect x="0" y="0" width="1920" height="900" fill="#000000" />

            <!-- ========================= -->
            <!-- Ribbon path + arrow head  -->
            <!-- ========================= -->
            <!-- shadow -->
            <path d="M-80 520 L1250 320 L1500 470 L1640 350 L1900 420" stroke="#000" stroke-opacity="0.35"
                stroke-width="190" fill="none" stroke-linejoin="bevel" transform="translate(0 10)" />
            <!-- main ribbon -->
            <path d="M-80 520 L1250 320 L1500 470 L1640 350 L1900 420" stroke="url(#rib)" stroke-width="190"
                fill="none" stroke-linejoin="bevel" />
            <!-- top highlight -->
            <path d="M-80 452 L1250 252 L1500 402 L1640 282 L1900 352" stroke="#ffffff" stroke-opacity="0.55"
                stroke-width="6" fill="none" stroke-linejoin="bevel" />
            <!-- arrow head -->
            <polygon points="1900,420 1850,372 1852,468" fill="#EEF1FF" stroke="#C8CDE6" stroke-width="2" />

            <!-- ========================= -->
            <!-- Right illustration (AI + laptop) -->
            <!-- ========================= -->
            <g transform="translate(1410 40)">
                <!-- floating panels -->
                <g opacity="0.92">
                    <polygon points="50,10 230,10 185,56 5,56" fill="#7BE7FF" opacity="0.85" />
                    <polygon points="250,20 470,20 410,78 190,78" fill="#2D63FF" opacity="0.92" />
                    <polygon points="485,34 610,34 560,90 435,90" fill="#7BE7FF" opacity="0.72" />
                </g>

                <!-- AI 3D-ish -->
                <text x="70" y="300" font-size="190" font-weight="900" fill="#1B4BFF" opacity="0.9">AI</text>
                <text x="88" y="282" font-size="190" font-weight="900" fill="#CFEAFF" opacity="0.95">AI</text>

                <!-- laptop base -->
                <polygon points="260,340 560,240 700,340 400,440" fill="#0B2CE8" />
                <polygon points="270,335 560,240 690,335 400,430" fill="#4ED0FF" opacity="0.65" />

                <!-- keyboard -->
                <polygon points="345,352 560,270 635,320 420,402" fill="#DDF5FF" opacity="0.88" />
                <g fill="#7BE7FF" opacity="0.5">
                    <polygon points="360,352 382,345 392,350 370,357" />
                    <polygon points="396,340 418,333 428,338 406,345" />
                    <polygon points="432,328 454,321 464,326 442,333" />
                    <polygon points="468,316 490,309 500,314 478,321" />
                    <polygon points="504,304 526,297 536,302 514,309" />
                </g>

                <!-- screen -->
                <polygon points="420,150 650,70 760,140 530,220" fill="#0E2A6A" opacity="0.88" />
                <polygon points="430,150 650,78 750,140 530,214" fill="#2D63FF" opacity="0.95" />
                <polygon points="470,125 635,82 710,118 545,162" fill="#7BE7FF" opacity="0.25" />
            </g>

            <!-- ========================= -->
            <!-- Icon circles + shadows    -->
            <!-- ========================= -->

            <!-- STEP 1 big -->
            <g>
                <ellipse cx="360" cy="480" rx="190" ry="44" fill="#2D63FF" opacity="0.35"
                    filter="url(#softBlur)" />
                <circle cx="360" cy="280" r="185" fill="#0B2CE8" />
                <!-- magnifier -->
                <g transform="translate(360 280)" fill="none" stroke="#FFFFFF" stroke-width="10"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="-10" cy="-10" r="62" />
                    <path d="M35 35 L110 110" />
                    <path d="M-35 -70 C-5 -92 30 -90 52 -66" opacity="0.65" />
                </g>
            </g>

            <!-- STEP 2 -->
            <g>
                <ellipse cx="720" cy="462" rx="135" ry="32" fill="#2D63FF"
                    opacity="0.25" filter="url(#softBlur)" />
                <circle cx="720" cy="262" r="145" fill="#0A78FF" />
                <!-- bulb+gear simplified -->
                <g transform="translate(720 262)" fill="none" stroke="#FFFFFF" stroke-width="8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M0 -80 C-46 -80 -70 -46 -70 -18 C-70 10 -46 28 -28 45 C-10 62 -10 78 -10 90 H10 C10 78 10 62 28 45 C46 28 70 10 70 -18 C70 -46 46 -80 0 -80 Z" />
                    <path d="M-28 100 H28" />
                    <path d="M-22 122 H22" />
                    <circle cx="62" cy="-10" r="26" opacity="0.9" />
                    <path d="M62 -50V-64M62 30V44M22 -10H8M116 -10H102" />
                    <path d="M40 -32 L28 -44M84 12 L96 24M84 -32 L96 -44M40 12 L28 24" />
                </g>
            </g>

            <!-- STEP 3 -->
            <g>
                <ellipse cx="1040" cy="450" rx="135" ry="32" fill="#4ED0FF"
                    opacity="0.22" filter="url(#softBlur)" />
                <circle cx="1040" cy="262" r="145" fill="#06B6F0" />
                <!-- code window -->
                <g transform="translate(1040 262)" fill="none" stroke="#FFFFFF" stroke-width="8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="-70" y="-70" width="140" height="140" rx="14" />
                    <path d="M-70 -38 H70" opacity="0.75" />
                    <path d="M-40 -54 H-24M-12 -54 H4M18 -54 H34" opacity="0.9" />
                    <path d="M-22 10 L-48 30 L-22 50" />
                    <path d="M22 10 L48 30 L22 50" />
                    <path d="M2 6 L-10 54" />
                </g>
            </g>

            <!-- STEP 4 (smaller) -->
            <g>
                <ellipse cx="1248" cy="410" rx="92" ry="20" fill="#4ED0FF"
                    opacity="0.25" filter="url(#softBlur)" />
                <circle cx="1248" cy="220" r="92" fill="#00C8F5" />
                <!-- headset -->
                <g transform="translate(1248 220)" fill="none" stroke="#FFFFFF" stroke-width="7"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M-50 10 V-6 C-50 -54 -22 -82 0 -82 C22 -82 50 -54 50 -6 V10" />
                    <rect x="-64" y="6" width="24" height="44" rx="10" />
                    <rect x="40" y="6" width="24" height="44" rx="10" />
                    <path d="M-12 56 C6 70 30 66 38 50" />
                    <path d="M38 50 H56" />
                </g>
            </g>

            <!-- ========================= -->
            <!-- Dashed connectors + underlines -->
            <!-- ========================= -->
            <!-- Step 1 -->
            <path d="M285 470 L220 680" class="dash" fill="none" />
            <path d="M220 680 H560" class="dash" fill="none" />
            <!-- Step 2 -->
            <path d="M720 430 V680" class="dash" fill="none" />
            <path d="M600 680 H940" class="dash" fill="none" />
            <!-- Step 3 -->
            <path d="M1070 430 L940 680" class="dash" fill="none" />
            <path d="M900 680 H1240" class="dash" fill="none" />
            <!-- Step 4 -->
            <path d="M1288 320 L1410 680" class="dash" fill="none" />
            <path d="M1370 680 H1780" class="dash" fill="none" />

            <!-- ========================= -->
            <!-- Text blocks -->
            <!-- ========================= -->

            <!-- STEP 01 -->
            <g text-anchor="middle">
                <text x="380" y="610" font-size="18" class="step">01</text>
                <text x="380" y="660" font-size="42" class="title">Discover &amp;</text>
                <text x="380" y="704" font-size="42" class="title">Strategize</text>

                <text x="380" y="790" font-size="26" class="desc">
                    <tspan x="380" dy="0">We start by getting to</tspan>
                    <tspan x="380" dy="32">know your business, your</tspan>
                    <tspan x="380" dy="32">goals, and your data to</tspan>
                    <tspan x="380" dy="32">find the best</tspan>
                    <tspan x="380" dy="32">opportunities for AI.</tspan>
                </text>
            </g>

            <!-- STEP 02 -->
            <g text-anchor="middle">
                <text x="760" y="610" font-size="18" class="step">02</text>
                <text x="760" y="660" font-size="42" class="title">Design A</text>
                <text x="760" y="704" font-size="42" class="title">Custom Solution</text>

                <text x="760" y="790" font-size="26" class="desc">
                    <tspan x="760" dy="0">Our AI experts then design a</tspan>
                    <tspan x="760" dy="32">solution tailored specifically</tspan>
                    <tspan x="760" dy="32">for your needs, with a focus</tspan>
                    <tspan x="760" dy="32">on security and long-term</tspan>
                    <tspan x="760" dy="32">growth.</tspan>
                </text>
            </g>

            <!-- STEP 03 -->
            <g text-anchor="middle">
                <text x="1060" y="610" font-size="18" class="step">03</text>
                <text x="1060" y="660" font-size="42" class="title">Build &amp;</text>
                <text x="1060" y="704" font-size="42" class="title">Integrate</text>

                <text x="1060" y="790" font-size="26" class="desc">
                    <tspan x="1060" dy="0">We handle all the</tspan>
                    <tspan x="1060" dy="32">development and testing,</tspan>
                    <tspan x="1060" dy="32">making sure the new AI</tspan>
                    <tspan x="1060" dy="32">solution fits perfectly into</tspan>
                    <tspan x="1060" dy="32">your current workflow.</tspan>
                </text>
            </g>

            <!-- STEP 04 -->
            <g text-anchor="middle">
                <text x="1660" y="610" font-size="18" class="step">04</text>
                <text x="1660" y="660" font-size="42" class="title">Support &amp;</text>
                <text x="1660" y="704" font-size="42" class="title">Refine</text>

                <text x="1660" y="790" font-size="26" class="desc">
                    <tspan x="1660" dy="0">After launch, we don't just</tspan>
                    <tspan x="1660" dy="32">disappear. We continuously</tspan>
                    <tspan x="1660" dy="32">monitor the system's</tspan>
                    <tspan x="1660" dy="32">performance, make tweaks to</tspan>
                    <tspan x="1660" dy="32">improve accuracy, and</tspan>
                    <tspan x="1660" dy="32">provide ongoing support.</tspan>
                </text>
            </g>
        </svg>
    </div>
</section>

<!-- ========================= -->
<!-- MOBILE (< lg): vertical UI -->
<!-- ========================= -->
<section class="lg:hidden px-5 py-10">
    <!-- top mini ribbon -->
    <div class="mx-auto max-w-md">
        <div class="relative h-16">
            <div
                class="absolute inset-x-0 top-7 h-5 rounded-full bg-gradient-to-r from-slate-50 via-indigo-50 to-slate-200">
            </div>
            <div class="absolute right-0 top-5 h-9 w-9 rotate-45 bg-slate-100"></div>
        </div>

        <div class="mt-6 space-y-6">
            <!-- card helper -->
            <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="h-16 w-16 rounded-full bg-[#0B2CE8] grid place-items-center">
                            <!-- magnifier -->
                            <svg viewBox="0 0 24 24" class="h-9 w-9" fill="none" aria-hidden="true">
                                <circle cx="11" cy="11" r="6" stroke="white" stroke-width="2.4" />
                                <path d="M16 16l5 5" stroke="white" stroke-width="2.4" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-extrabold tracking-widest text-[#0B2CE8]">
                            01
                        </div>
                        <div class="text-xl font-extrabold text-white leading-tight">
                            Discover &amp; Strategize
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-white/70">
                    We start by getting to know your business, your goals, and your data to
                    find the best opportunities for AI.
                </p>
            </div>

            <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 rounded-full bg-[#0A78FF] grid place-items-center">
                        <!-- bulb -->
                        <svg viewBox="0 0 24 24" class="h-9 w-9" fill="none" aria-hidden="true">
                            <path d="M9 21h6M10 18h4" stroke="white" stroke-width="2.2" stroke-linecap="round" />
                            <path d="M12 2a7 7 0 0 0-4 12c.8.7 1 1.3 1 2h6c0-.7.2-1.3 1-2A7 7 0 0 0 12 2Z"
                                stroke="white" stroke-width="2.2" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-extrabold tracking-widest text-[#0B2CE8]">
                            02
                        </div>
                        <div class="text-xl font-extrabold text-white leading-tight">
                            Design A Custom Solution
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-white/70">
                    Our AI experts then design a solution tailored specifically for your needs,
                    with a focus on security and long-term growth.
                </p>
            </div>

            <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 rounded-full bg-[#06B6F0] grid place-items-center">
                        <!-- code -->
                        <svg viewBox="0 0 24 24" class="h-9 w-9" fill="none" aria-hidden="true">
                            <path d="M4 5h16v14H4z" stroke="white" stroke-width="2.2" stroke-linejoin="round" />
                            <path d="M8 10l-2 2 2 2" stroke="white" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16 10l2 2-2 2" stroke="white" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M13 9l-2 6" stroke="white" stroke-width="2.2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-extrabold tracking-widest text-[#0B2CE8]">
                            03
                        </div>
                        <div class="text-xl font-extrabold text-white leading-tight">
                            Build &amp; Integrate
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-white/70">
                    We handle all the development and testing, making sure the new AI solution
                    fits perfectly into your current workflow.
                </p>
            </div>

            <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 rounded-full bg-[#00C8F5] grid place-items-center">
                        <!-- headset -->
                        <svg viewBox="0 0 24 24" class="h-9 w-9" fill="none" aria-hidden="true">
                            <path d="M4 12a8 8 0 0 1 16 0" stroke="white" stroke-width="2.2"
                                stroke-linecap="round" />
                            <path d="M6 12v6a2 2 0 0 0 2 2h1v-8H8a2 2 0 0 0-2 2Z" stroke="white"
                                stroke-width="2.2" stroke-linejoin="round" />
                            <path d="M18 12v6a2 2 0 0 1-2 2h-1v-8h1a2 2 0 0 1 2 2Z" stroke="white"
                                stroke-width="2.2" stroke-linejoin="round" />
                            <path d="M15 20c0 1-1.5 2-3 2s-3-1-3-2" stroke="white" stroke-width="2.2"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-extrabold tracking-widest text-[#0B2CE8]">
                            04
                        </div>
                        <div class="text-xl font-extrabold text-white leading-tight">
                            Support &amp; Refine
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-white/70">
                    After launch, we continuously monitor performance, make tweaks to improve
                    accuracy, and provide ongoing support.
                </p>
            </div>

            <!-- tiny "AI" footer illustration hint -->
            <div class="pt-2 text-center text-white/60 text-sm">
                <span class="font-extrabold text-white">AI</span> — ongoing iteration &amp; improvement
            </div>
        </div>
    </div>
</section>