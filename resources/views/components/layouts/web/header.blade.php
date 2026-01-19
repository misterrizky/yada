<header class="sticky top-0 z-50 bg-white dark:bg-black overflow-x-hidden">
    <div class="container mx-auto w-full max-w-6xl px-4">
        <div class="flex items-center justify-between py-3">
            <!-- Brand -->
            <a href="{{ route('web.home') }}" wire:navigate class="group inline-flex min-w-0 items-center gap-2">
                <img src="{{ asset('icon.png') }}" alt="" class="h-8 w-auto block dark:hidden" />
                <img src="{{ asset('icon-dark.png') }}" alt="" class="h-8 w-auto hidden dark:block" />
                <div class="min-w-0 leading-tight">
                    <div class="text-sm font-semibold tracking-wide truncate">Yada Ekidanta</div>
                    <div class="text-[11px] dark:text-white/60 text-black/60 truncate hidden sm:block">Tech Innovation Partner</div>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav data-desktop-nav class="relative hidden items-center gap-2 md:flex">
                <!-- Active indicator -->
                <div id="navIndicator"
                    class="pointer-events-none absolute -bottom-[6px] left-0 h-[2px] w-10 rounded-full bg-white/80 opacity-70">
                </div>

                <!-- Solutions (mega) -->
                <a id="btnSolutions" href="{{ route('web.solutions') }}" wire:navigate data-nav-key="solutions"
                    class="yex-magnetic inline-flex items-center rounded-2xl px-4 py-2 text-sm font-semibold text-gray/80 dark:text-white/80 dark:hover:text-white hover:text-gray dark:hover:bg-white/5 hover:bg-gray/5 ring-1 ring-transparent dark:hover:ring-white/10 hover:ring-black/10 transition">
                    Solutions
                </a>
                <a id="navWorks" href="{{ route('web.works') }}" wire:navigate data-nav-key="works"
                    class="yex-magnetic inline-flex items-center rounded-2xl px-4 py-2 text-sm font-semibold text-gray/80 dark:text-white/80 dark:hover:text-white hover:text-gray dark:hover:bg-white/5 hover:bg-gray/5 ring-1 ring-transparent dark:hover:ring-white/10 hover:ring-black/10 transition">
                    Works
                </a>
                <!-- Works (mini mega) -->
                <button id="btnWorks" type="button" data-nav-key="works"
                    class="yex-magnetic hidden items-center gap-2 rounded-2xl px-4 py-2 text-sm font-semibold text-gray/80 dark:text-white/80 dark:hover:text-white hover:text-gray dark:hover:bg-white/5 hover:bg-gray/5 ring-1 ring-transparent dark:hover:ring-white/10 hover:ring-black/10 transition"
                    aria-expanded="false" aria-controls="megaWorks">
                    Works
                    <span class="inline-block h-2 w-2 rotate-45 border-r border-b dark:border-white/50 border-gray/50"></span>
                </button>

                <!-- Explore More (mega) -->
                <button id="btnExplore" type="button" data-nav-key="explore"
                    class="yex-magnetic inline-flex items-center gap-2 rounded-2xl px-4 py-2 text-sm font-semibold dark:text-white/80 text-gray/80 dark:hover:text-white hover:text-gray dark:hover:bg-white/5 hover:bg-gray/5 ring-1 ring-transparent dark:hover:ring-white/10 hover:ring-black/10 transition"
                    aria-expanded="false" aria-controls="megaExplore">
                    Explore More
                    <span class="inline-block h-2 w-2 rotate-45 border-r border-b dark:border-white/50 border-gray/50"></span>
                </button>

                <!-- Contact -->
                <a id="navContact" href="{{ route('web.contact') }}" wire:navigate data-nav-key="contact"
                    class="yex-magnetic inline-flex items-center rounded-2xl px-4 py-2 text-sm font-semibold text-gray/80 dark:text-white/80 dark:hover:text-white hover:text-gray dark:hover:bg-white/5 hover:bg-gray/5 ring-1 ring-transparent dark:hover:ring-white/10 hover:ring-black/10 transition">
                    Contact Us
                </a>
            </nav>
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" data-theme-toggle class="cursor-pointer text-muted-foreground hover:bg-transparent hover:text-foreground inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50 size-9" aria-label="Toggle theme">
                    <!-- Sun (muncul saat light) -->
                    <svg data-theme-icon="sun" class="size-4 hidden text-yellow-300 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>
                    <!-- Moon (muncul saat dark) -->
                    <svg data-theme-icon="moon" class="size-4 text-black block dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" >
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>
                </button>
                <!-- Mobile toggle -->
                <button id="btnMobile"
                    class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-2xl dark:bg-white/5 bg-black/5 ring-1 dark:ring-white/10 ring-black/10"
                    aria-label="Open Menu" aria-expanded="false" aria-controls="mobileDrawer">
                    <span class="relative block h-4 w-5">
                        <span class="absolute left-0 top-0 h-[2px] w-5 dark:bg-white/80 bg-black/80 rounded"></span>
                        <span class="absolute left-0 top-2 h-[2px] w-5 dark:bg-white/80 bg-black/80 rounded"></span>
                        <span class="absolute left-0 top-4 h-[2px] w-5 dark:bg-white/80 bg-black/80 rounded"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <!-- ===== Mega Overlay (shared backdrop) ===== -->
    <div id="megaOverlay" class="fixed inset-0 z-[70] opacity-0 invisible pointer-events-none" aria-hidden="true">

        <!-- Backdrop -->
        <div id="megaBackdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <!-- Panel wrapper -->
        <div class="absolute left-0 right-0 top-[64px]">
            <div class="container mx-auto w-full max-w-6xl px-4">
                <div id="megaPanel" role="dialog" aria-modal="true"
                    class="relative overflow-hidden rounded-[2rem] bg-zinc-950/75 ring-1 ring-white/10 shadow-2xl opacity-100 scale-[0.98] max-h-[calc(100vh-96px)]">

                    <!-- Parallax glow -->
                    <div id="megaParallaxGlow" class="absolute -inset-24 opacity-100 pointer-events-none"
                        style="background: radial-gradient(700px circle at 20% 20%, rgba(124,58,237,0.20), transparent 55%), radial-gradient(650px circle at 80% 80%, rgba(34,211,238,0.16), transparent 60%);">
                    </div>

                    <!-- Mega parallax content wrapper -->
                    <div id="megaInner"
                        class="relative will-change-transform max-h-[calc(100vh-96px)] overflow-y-auto overscroll-contain">

                        <!-- Close row -->
                        <div class="relative flex items-center justify-between border-b border-white/10 px-6 py-4">
                            <div class="text-sm font-semibold text-white/90">Menu</div>
                            <button id="btnMegaClose"
                                class="yex-magnetic inline-flex items-center gap-2 rounded-2xl bg-white/5 px-3 py-2 text-xs font-semibold text-white ring-1 ring-white/10 hover:bg-white/10 transition"
                                type="button">
                                Close
                                <span class="inline-block h-3 w-3 relative">
                                    <span
                                        class="absolute inset-0 rotate-45 h-[2px] w-3 bg-white/70 top-1/2 -translate-y-1/2"></span>
                                    <span
                                        class="absolute inset-0 -rotate-45 h-[2px] w-3 bg-white/70 top-1/2 -translate-y-1/2"></span>
                                </span>
                            </button>
                        </div>

                        <!-- ===== Solutions Mega ===== -->
                        <div id="megaSolutions" class="relative hidden">
                            <div class="grid gap-0 md:grid-cols-12">
                                <!-- Left: categories (col-4) -->
                                <aside class="md:col-span-4 border-b md:border-b-0 md:border-r border-white/10 p-5">
                                    <div class="text-xs text-white/60">Categories</div>
                                    <div class="mt-3 grid gap-2" role="tablist" aria-label="Solutions categories">
                                        <button
                                            class="yex-sol-tab text-left rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10 hover:bg-white/15 transition"
                                            id="tab-ai" role="tab" aria-controls="panel-ai"
                                            aria-selected="false" tabindex="-1" data-tab="ai" type="button">
                                            <div class="text-sm text-white/80 font-semibold">AI Solutions</div>
                                            <div class="mt-1 text-xs text-white/60">AI development & automation</div>
                                        </button>

                                        <button
                                            class="yex-sol-tab text-left rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10 hover:bg-white/15 transition"
                                            id="tab-software" role="tab" aria-controls="panel-software"
                                            aria-selected="false" tabindex="-1" data-tab="software" type="button">
                                            <div class="text-sm text-white/80 font-semibold">Software Development</div>
                                            <div class="mt-1 text-xs text-white/60">Build, run, scale products</div>
                                        </button>

                                        <button
                                            class="yex-sol-tab text-left rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10 hover:bg-white/15 transition"
                                            id="tab-is" role="tab" aria-controls="panel-is"
                                            aria-selected="false" tabindex="-1" data-tab="is" type="button">
                                            <div class="text-sm text-white/80 font-semibold">Information System</div>
                                            <div class="mt-1 text-xs text-white/60">Best-of-breed platforms</div>
                                        </button>

                                        <button
                                            class="yex-sol-tab text-left rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10 hover:bg-white/15 transition"
                                            id="tab-cyber" role="tab" aria-controls="panel-cyber"
                                            aria-selected="false" tabindex="-1" data-tab="cyber" type="button">
                                            <div class="text-sm text-white/80 font-semibold">Cyber Security</div>
                                            <div class="mt-1 text-xs text-white/60">Protect • Detect • Advisory</div>
                                        </button>

                                        <button
                                            class="yex-sol-tab text-left rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10 hover:bg-white/15 transition"
                                            id="tab-cloud" role="tab" aria-controls="panel-cloud"
                                            aria-selected="false" tabindex="-1" data-tab="cloud" type="button">
                                            <div class="text-sm text-white/80 font-semibold">Cloud Solutions</div>
                                            <div class="mt-1 text-xs text-white/60">Cloud + Data Center</div>
                                        </button>
                                    </div>
                                </aside>

                                <!-- Right: content (col-8) -->
                                <section class="md:col-span-8 p-6">
                                    <!-- AI Solutions -->
                                    <div class="yex-sol-panel" data-panel="ai" id="panel-ai" role="tabpanel"
                                        aria-labelledby="tab-ai">
                                        <div class="grid gap-6 md:grid-cols-12 md:items-center">
                                            <div class="md:col-span-6">
                                                <h5 class="text-xl text-white font-semibold">AI Development</h5>
                                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                                    Empower your business with end-to-end AI Development. We assess
                                                    needs, strategies, and deploy intelligent AI solutions to transform
                                                    operations and engagement.
                                                </p>
                                                <div class="mt-5">
                                                    <a href="#services"
                                                        class="yex-magnetic inline-flex items-center justify-center rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-zinc-950 ring-1 ring-white/10">
                                                        Discover More
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="md:col-span-6">
                                                <img class="w-full aspect-[3/3] object-contain mix-blend-color-burn"
                                                    src="{{ asset('assets/media/solutions/ai-development.png') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Software Development -->
                                    <div class="yex-sol-panel hidden" data-panel="software" id="panel-software"
                                        role="tabpanel" aria-labelledby="tab-software">
                                        <div class="grid gap-4">
                                            <div class="col-span-12">
                                                <h5 class="text-xl text-white font-semibold">Software Development</h5>
                                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                                    Our services cut across various industries and our expertise covered
                                                    many technologies.
                                                </p>
                                            </div>

                                            <div class="grid gap-4 md:grid-cols-12">
                                                <div class="md:col-span-6 grid gap-3">
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Agile Development</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            On Extended Team Service, customer get the help from our
                                                            experts as additional resource and has free reign over the
                                                            project management with flexible spec.
                                                        </p>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Project Based</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Consult build all kind of custom made apps. For your
                                                            company's promotional, operational, and human resource
                                                            needs.
                                                        </p>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Managed Services</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Our team consists of experienced and tech-savvy developers.
                                                            We can help you to maintain your application professionally.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="md:col-span-6 grid gap-3">
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Design Services</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Our design team is design studio within a large software
                                                            company that will help you build an engaging product easily
                                                            and quickly.
                                                        </p>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Technical Writer</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Map your business process according to the specifications
                                                            and requirements needed in the application.
                                                        </p>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Quality Assurance</div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Testing is the process to ensure applications or websites
                                                            meet general or specific quality standards.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Information System -->
                                    <div class="yex-sol-panel hidden" data-panel="is" id="panel-is" role="tabpanel"
                                        aria-labelledby="tab-is">
                                        <div class="grid gap-6 md:grid-cols-12 md:items-center">
                                            <div class="md:col-span-6">
                                                <h5 class="text-xl text-white font-semibold">Information System</h5>
                                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                                    We collaborate with emerging leaders and best-of-breed IT
                                                    solutions—platforms recognized by Gartner and Forrester for their
                                                    innovative excellence.
                                                </p>
                                                <div class="mt-5">
                                                    <a href="#services"
                                                        class="yex-magnetic inline-flex items-center justify-center rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-zinc-950 ring-1 ring-white/10">
                                                        Discover More
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="md:col-span-6">
                                                <div
                                                    class="relative overflow-hidden rounded-3xl bg-white/5 ring-1 ring-white/10 p-6">
                                                    <div class="absolute inset-0 opacity-80"
                                                        style="background: radial-gradient(700px circle at 30% 20%, rgba(56,189,248,.28), transparent 55%), radial-gradient(600px circle at 70% 70%, rgba(251,113,133,.22), transparent 60%);">
                                                    </div>
                                                    <div class="relative">
                                                        <div class="text-xs text-white/60">Information System</div>
                                                        <div class="mt-2 text-sm text-white/80">
                                                            Platforms • Integration • Governance • Reporting
                                                        </div>
                                                        <div class="mt-4 grid grid-cols-2 gap-3 text-xs text-white/70">
                                                            <div
                                                                class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                                Governance</div>
                                                            <div
                                                                class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                                Integration</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cyber Security -->
                                    <div class="yex-sol-panel hidden" data-panel="cyber" id="panel-cyber"
                                        role="tabpanel" aria-labelledby="tab-cyber">
                                        <div class="grid gap-4">
                                            <div class="col-span-12">
                                                <h5 class="text-xl text-white font-semibold">Cyber Security Powered by Temika
                                                    Cyber</h5>
                                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                                    Protect your business with end-to-end cyber security solutions that
                                                    safeguard data, systems, and operations from evolving threats.
                                                </p>
                                            </div>

                                            <div class="grid gap-4 md:grid-cols-12">
                                                <div class="md:col-span-6 grid gap-3">
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cyber Protect Service</div>
                                                        <ul
                                                            class="mt-2 space-y-1 text-sm text-white/70 list-disc pl-5">
                                                            <li>Penetration Testing</li>
                                                            <li>Red Teaming Real World Simulation Attack</li>
                                                        </ul>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cyber Detect Service</div>
                                                        <ul
                                                            class="mt-2 space-y-1 text-sm text-white/70 list-disc pl-5">
                                                            <li>Managed Detection and Response</li>
                                                            <li>Managed Service Security Operation Center</li>
                                                        </ul>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cyber Advisory Service</div>
                                                        <ul
                                                            class="mt-2 space-y-1 text-sm text-white/70 list-disc pl-5">
                                                            <li>ISO 27001_2022</li>
                                                            <li>DPOaaS - Data Protection Officer as a Service</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="md:col-span-6 grid gap-3">
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cyber Security Solutions
                                                        </div>
                                                        <ul
                                                            class="mt-2 space-y-1 text-sm text-white/70 list-disc pl-5">
                                                            <li>Blackberry Security</li>
                                                            <li>Imperva</li>
                                                            <li>First Watch</li>
                                                            <li>Endpoint Protector by CoSoSys</li>
                                                            <li>Menlo Security</li>
                                                            <li>Threat Management by Cicada8</li>
                                                            <li>Safe Cities by VisionLabs</li>
                                                        </ul>
                                                    </div>
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cyber Corporate Training
                                                        </div>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Builds employee skills in cybersecurity to reduce risks and
                                                            boost organizational security awareness.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cloud Solutions -->
                                    <div class="yex-sol-panel hidden" data-panel="cloud" id="panel-cloud"
                                        role="tabpanel" aria-labelledby="tab-cloud">
                                        <div class="grid gap-4">
                                            <div class="col-span-12">
                                                <h5 class="text-xl text-white font-semibold">Cloud Solutions</h5>
                                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                                    From building robust data centers to enabling cloud transformation,
                                                    we provide end-to-end solutions tailored to your business needs.
                                                </p>
                                            </div>

                                            <div class="grid gap-4 md:grid-cols-12">
                                                <div class="md:col-span-6 grid gap-3">
                                                    <div class="rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                        <div class="text-sm text-white font-semibold">Cloud Solutions</div>
                                                        <ul
                                                            class="mt-2 space-y-1 text-sm text-white/70 list-disc pl-5">
                                                            <li>Alibaba Cloud</li>
                                                            <li>IBM Watson X</li>
                                                            <li>Zettagrid</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="md:col-span-6 grid gap-3">
                                                    <a href="data-center.html"
                                                        class="group rounded-3xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 transition">
                                                        <div class="flex items-center justify-between">
                                                            <div class="text-sm text-white font-semibold">Data Center
                                                                Constructions</div>
                                                            <span
                                                                class="text-xs text-white/60 group-hover:text-white/80 transition">→
                                                                Detail</span>
                                                        </div>
                                                        <p class="mt-2 text-sm font-semibold text-white/85">
                                                            We build safe and flexible data centers to support storage,
                                                            IT systems, and digital work.
                                                        </p>
                                                        <p class="mt-2 text-sm text-white/70">
                                                            Involve Designing And Building Secure, Scalable Facilities
                                                            Equipped With Advanced Cooling, Power, And Network
                                                            Infrastructure To Support Critical It Operations
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                        <!-- ===== Explore More Mega ===== -->
                        <div id="megaExplore" class="relative hidden">
                            <div class="grid gap-6 md:grid-cols-12 p-6">
                                <!-- col-4 -->
                                <div class="yex-mega-anim md:col-span-4">
                                    <h5 class="text-xl text-white font-semibold">EXPLORE MORE</h5>
                                    <p class="mt-2 text-sm leading-relaxed text-white/70">
                                        Strength in diversity is something we are proud of as a pioneer in agile project
                                        management. Our dedication to creating an impact with every line of code is
                                        something we take to heart for everyone involved.
                                    </p>
                                </div>

                                <!-- col-4 -->
                                <div class="yex-mega-anim md:col-span-4">
                                    <div class="grid gap-2">
                                        <a href="{{ route('web.about') }}" wire:navigate
                                            class="yex-magnetic group rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 hover:bg-white/10 transition flex items-center justify-between">
                                            <span class="text-sm text-white font-semibold">About Company</span>
                                            <span class="text-white/60 group-hover:text-white/80 transition">→</span>
                                        </a>
                                        <a href="{{ route('web.careers') }}" wire:navigate
                                            class="yex-magnetic group rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 hover:bg-white/10 transition flex items-center justify-between">
                                            <span class="text-sm text-white font-semibold">Career at YE</span>
                                            <span class="text-white/60 group-hover:text-white/80 transition">→</span>
                                        </a>
                                        <a href="{{ route('web.blogs') }}" wire:navigate
                                            class="yex-magnetic group rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 hover:bg-white/10 transition flex items-center justify-between">
                                            <span class="text-sm text-white font-semibold">Blog</span>
                                            <span class="text-white/60 group-hover:text-white/80 transition">→</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- col-4 image -->
                                <div class="yex-mega-anim md:col-span-4">
                                    <div
                                        class="relative overflow-hidden rounded-3xl bg-white/5 ring-1 ring-white/10 p-6 h-full min-h-[180px]">
                                        <div class="absolute inset-0 opacity-90"
                                            style="background: radial-gradient(700px circle at 20% 10%, rgba(34,197,94,.25), transparent 55%), radial-gradient(650px circle at 80% 80%, rgba(167,139,250,.28), transparent 60%);">
                                        </div>
                                        <div class="absolute inset-0 yex-grid opacity-35"></div>
                                        <div class="relative">
                                            <div class="text-xs text-white/60">YE Culture</div>
                                            <div class="mt-2 text-sm text-white/80">
                                                Collaborative Integrity • Continuous Evolution • Impactful Innovation
                                            </div>
                                            <div class="mt-4 grid grid-cols-2 gap-3 text-xs text-white/70">
                                                <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">About
                                                </div>
                                                <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                    Careers</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ===== Works Mini Mega (Enhanced + Preview) ===== -->
                        <div id="megaWorks" class="relative hidden">
                            <div class="grid gap-0 md:grid-cols-12">
                                <!-- Left (col-4) -->
                                <aside
                                    class="yex-mega-anim md:col-span-4 border-b md:border-b-0 md:border-r border-white/10 p-5">
                                    <div class="text-xs text-white/60">WORKS</div>
                                    <div class="mt-2 text-sm text-white/80">
                                        Quick access ke highlight portfolio. Pilih kategori untuk filter di section
                                        Projects.
                                    </div>

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/10 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/15 transition"
                                            data-filter="all" data-preview-title="All Works"
                                            data-preview-sub="Highlights across YE portfolio"
                                            data-preview-c1="#7c3aed" data-preview-c2="#06b6d4"
                                            type="button">All</button>

                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/5 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/10 transition"
                                            data-filter="gov" data-preview-title="GovTech"
                                            data-preview-sub="Platforms • workflow • governance"
                                            data-preview-c1="#60a5fa" data-preview-c2="#22c55e"
                                            type="button">GovTech</button>

                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/5 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/10 transition"
                                            data-filter="ai" data-preview-title="AI & Data"
                                            data-preview-sub="Vision • NLP • Analytics" data-preview-c1="#a78bfa"
                                            data-preview-c2="#fb7185" type="button">AI & Data</button>

                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/5 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/10 transition"
                                            data-filter="enterprise" data-preview-title="Enterprise"
                                            data-preview-sub="POS • ops • performance" data-preview-c1="#f59e0b"
                                            data-preview-c2="#22c55e" type="button">Enterprise</button>

                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/5 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/10 transition"
                                            data-filter="brand" data-preview-title="Brand & Web"
                                            data-preview-sub="Company profile • UX • SEO" data-preview-c1="#fb7185"
                                            data-preview-c2="#a78bfa" type="button">Brand & Web</button>

                                        <button
                                            class="yex-work-filter yex-magnetic rounded-full bg-white/5 px-4 py-2 text-xs font-semibold ring-1 ring-white/10 hover:bg-white/10 transition"
                                            data-filter="overseas" data-preview-title="Overseas"
                                            data-preview-sub="Global delivery • modern stack"
                                            data-preview-c1="#22d3ee" data-preview-c2="#7c3aed"
                                            type="button">Overseas</button>
                                    </div>

                                    <a href="{{ route('web.works') }}" wire:navigate
                                        class="yex-work-jump yex-magnetic mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-zinc-950 ring-1 ring-white/10">
                                        View all works
                                    </a>
                                </aside>

                                <!-- Right (col-8) -->
                                <section class="md:col-span-8 p-6">
                                    <div class="grid gap-4 md:grid-cols-12">
                                        <!-- Cards (col-7) -->
                                        <div class="yex-mega-anim md:col-span-7 grid gap-4">
                                            <button type="button"
                                                class="yex-work-card group text-left rounded-3xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 transition"
                                                data-filter="ai" data-jump="#projects"
                                                data-preview-title="AI Counting Food Tray"
                                                data-preview-sub="AI / Computer Vision" data-preview-c1="#a78bfa"
                                                data-preview-c2="#fb7185">
                                                <div class="text-xs text-white/60">AI / Computer Vision</div>
                                                <div class="mt-2 text-sm text-white font-semibold">AI Counting Food Tray</div>
                                                <div class="mt-2 text-sm text-white/70">End-to-end AI untuk operasi
                                                    skala besar.</div>
                                                <div
                                                    class="mt-4 text-xs text-white/60 group-hover:text-white/80 transition">
                                                    Open →</div>
                                            </button>

                                            <button type="button"
                                                class="yex-work-card group text-left rounded-3xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 transition"
                                                data-filter="gov" data-jump="#projects"
                                                data-preview-title="IKN Competition Platform"
                                                data-preview-sub="GovTech / Competition" data-preview-c1="#60a5fa"
                                                data-preview-c2="#22c55e">
                                                <div class="text-xs text-white/60">GovTech Platform</div>
                                                <div class="mt-2 text-sm text-white font-semibold">IKN Competition Platform</div>
                                                <div class="mt-2 text-sm text-white/70">Workflow kompleks,
                                                    high-traffic, rapi.</div>
                                                <div
                                                    class="mt-4 text-xs text-white/60 group-hover:text-white/80 transition">
                                                    Open →</div>
                                            </button>

                                            <button type="button"
                                                class="yex-work-card group text-left rounded-3xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 transition"
                                                data-filter="enterprise" data-jump="#projects"
                                                data-preview-title="Ayo Toko & Ayo Cashier"
                                                data-preview-sub="Enterprise / POS" data-preview-c1="#f59e0b"
                                                data-preview-c2="#22c55e">
                                                <div class="text-xs text-white/60">Enterprise / POS</div>
                                                <div class="mt-2 text-sm text-white font-semibold">Ayo Toko & Ayo Cashier</div>
                                                <div class="mt-2 text-sm text-white/70">Performance + reliability untuk
                                                    retail ops.</div>
                                                <div
                                                    class="mt-4 text-xs text-white/60 group-hover:text-white/80 transition">
                                                    Open →</div>
                                            </button>
                                        </div>

                                        <!-- Preview (col-5) -->
                                        <div class="yex-mega-anim md:col-span-5">
                                            <div
                                                class="relative overflow-hidden rounded-3xl bg-white/5 ring-1 ring-white/10 p-5 min-h-[260px]">
                                                <div class="absolute inset-0 yex-grid opacity-35"></div>

                                                <div class="relative">
                                                    <div class="text-xs text-white/60">Preview</div>
                                                    <div id="worksPreviewTitle" class="mt-2 text-lg text-white font-semibold">All
                                                        Works</div>
                                                    <div id="worksPreviewSub" class="mt-1 text-sm text-white/70">
                                                        Highlights across YE portfolio</div>
                                                </div>

                                                <div
                                                    class="relative mt-4 overflow-hidden rounded-2xl ring-1 ring-white/10 bg-zinc-950/40">
                                                    <canvas id="worksPreviewCanvas"
                                                        class="block w-full h-[150px]"></canvas>
                                                    <div class="absolute inset-0 yex-noise"></div>
                                                </div>

                                                <div
                                                    class="relative mt-4 grid grid-cols-2 gap-3 text-xs text-white/70">
                                                    <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                        Fast delivery</div>
                                                    <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                        Maintainable</div>
                                                    <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                        Security-first</div>
                                                    <div class="rounded-2xl bg-zinc-950/40 p-3 ring-1 ring-white/10">
                                                        Scalable</div>
                                                </div>
                                            </div>

                                            <div class="mt-4 rounded-3xl bg-white/5 p-5 ring-1 ring-white/10">
                                                <div class="text-xs text-white/60">Tip</div>
                                                <div class="mt-1 text-sm text-white/70">
                                                    Hover card / klik kategori untuk update preview + auto-filter
                                                    Projects.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div><!-- /megaInner -->
                </div><!-- /megaPanel -->
            </div>
        </div>
    </div><!-- /megaOverlay -->

    <!-- ===== Mobile Drawer ===== -->
    <div id="mobileDrawer" class="fixed inset-0 z-[60] opacity-0 pointer-events-none" aria-hidden="true">
        <div id="mobileBackdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <aside id="mobilePanel"
            class="absolute right-0 top-0 h-full w-[86%] max-w-sm translate-x-full dark:bg-zinc-950/90 bg-white/45 ring-1 ring-white/10 overflow-y-auto">
            <div class="relative p-5 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold">Menu</div>
                    <button id="btnMobileClose"
                        class="yex-magnetic inline-flex items-center justify-center rounded-2xl bg-white/5 px-3 py-2 text-xs font-semibold text-white ring-1 ring-white/10 hover:bg-white/10 transition"
                        type="button">
                        Close
                    </button>
                </div>
                <div class="mt-3 text-xs text-white/60">Navigate YE experience</div>
            </div>

            <div class="p-5 space-y-3">
                <!-- Quick links -->
               
                <a href="{{ route('web.works') }}" wire:navigate
                    class="yex-magnetic block rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 transition dark:text-white text-black text-sm font-semibold text-zinc-950">
                    Works
                </a>
                <a href="{{ route('web.contact') }}" wire:navigate
                    class="yex-magnetic block rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 transition dark:text-white text-black text-sm font-semibold text-zinc-950">
                    Contact Us
                </a>

                <!-- Solutions accordion -->
                <a href="{{ route('web.solutions') }}" wire:navigate
                    class="yex-magnetic block rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10 transition text-sm font-semibold dark:text-white text-zinc-950">
                    Solutions
                </a>

                <!-- Explore More accordion -->
                <details class="rounded-2xl bg-white/5 ring-1 ring-white/10 overflow-hidden">
                    <summary
                        class="cursor-pointer list-none px-4 py-3 text-sm font-semibold flex items-center justify-between">
                        Explore More
                        <span class="text-white/60">+</span>
                    </summary>
                    <div class="px-4 pb-4 space-y-2 text-sm text-white/75">
                        <a class="block rounded-xl bg-zinc-950/40 px-3 py-2 ring-1 ring-white/10 hover:bg-white/10 transition"
                            href="{{ route('web.about') }}" wire:navigate>About Company</a>
                        <a class="block rounded-xl bg-zinc-950/40 px-3 py-2 ring-1 ring-white/10 hover:bg-white/10 transition"
                            href="{{ route('web.careers') }}" wire:navigate>Career at YE</a>
                        <a class="block rounded-xl bg-zinc-950/40 px-3 py-2 ring-1 ring-white/10 hover:bg-white/10 transition"
                            href="{{ route('web.home') }}" wire:navigate>Blog</a>
                    </div>
                </details>
            </div>
        </aside>
    </div><!-- /mobileDrawer -->
</header>
