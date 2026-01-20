<?php

use function Laravel\Folio\name;

name('web.solutions.technical-writer');
?>
<x-layouts.web :title="__('Technical Writer Services: Document IT Clarity')" :description="__('YE technical writers produce clear IT documentation, manuals, whitepapers, and process descriptions.')" :keywords="__('technical writing, documentation')">
    
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
                            Technical Writer
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

            <img src="{{ asset('assets/media/solutions/technical-writer.jpg') }}"
                alt="Technical Writer" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <hr class="border-gray-700">
                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Advantage of<br>
                            Technical Writer</p>
                        <ul>
                            <li class="text-lg font-semibold text-blue-600 py-5">SYSTEM BUSINESS PROVEN EXPERTISE</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">SAVE COST</li>
                            <li class="text-lg font-semibold text-blue-600 py-5">BUSINESS ROADMAP GOALS</li>
                        </ul>
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                System Business Proven Expertise
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Have insights on system / business operation with proven expertise and
                                experience
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Save Cost
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Save cost, because not all problems / pain point could be solved by
                                building system / apps, sometimes it only just need simple tools to answer the problems
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Full Control of System Development
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Have planning and full control of system development which comply with
                                company workflow / procedure
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Business Roadmap Goals
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Creating Roadmap for system development based on Business Priorities and
                                Goals
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Contributions
                            </dt>
                            <hr class="my-2 border-gray-700">
                            <dd class="mt-2">Sometimes it will need opinion and contribution from end users so in the
                                future there will be no hassle while adapting to the system or developing the system and
                                we will make sure end user will have contribution in the system planning by doing
                                interview / brainstorming with the end user
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="relative isolate">
        <div class="bg-white py-24 sm:py-32 dark:bg-black">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <hr class="border-gray-700">
                        <p
                            class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                            Pre-requisites
                    </div>
                    <dl
                        class="grid grid-cols-1 gap-x-6 gap-y-6 text-base/5 text-gray-600 sm:grid-cols-1 lg:gap-y-6 dark:text-gray-400">
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Client signature on SPK / Agreement</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Short brief about the project / apps that consists of the
                                        description of the project, purpose of the project, target user, and integration
                                        to internal system (if any)</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dd class="mt-2">
                                <ul>
                                    <li class="list-disc">Client will need to assign one PIC as communication channel to
                                        Client’s teams</li>
                                </ul>
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
                <div class="grid grid-cols-1 gap-14 lg:grid-cols-[520px_1fr] lg:items-start">
                    <!-- LEFT -->
                    <div>
                        <div class="h-[2px] w-full max-w-[430px] dark:bg-white/40 bg-black/40"></div>

                        <h2 class="mt-8 text-4xl font-extrabold dark:text-white text-black">
                            Deliverables
                        </h2>
                    </div>

                    <!-- RIGHT -->
                    <div class="max-w-[720px]">
                        <!-- ITEM 1 -->
                        <div class="flex items-start gap-4 pb-8">
                            <!-- Icon -->
                            <div class="mt-1 text-blue-700">
                                <!-- Document + Pen -->
                                <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M18 10h20l8 8v36H18V10Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M38 10v10h10" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M26 30h12" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    <path d="M26 38h16" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                    <path d="M41 41l10-10 3 3-10 10-4 1 1-4Z" stroke="currentColor" stroke-width="3"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>

                            <!-- Text -->
                            <div class="min-w-0">
                                <h3 class="text-sm font-extrabold dark:text-white text-black">
                                    MOM/Minutes of Meeting
                                </h3>
                                <p class="mt-2 text-sm leading-6 dark:text-white/55 text-black/55">
                                    MOM for every discussion by chat / phone / video call /
                                    direct meeting
                                </p>
                            </div>
                        </div>

                        <div class="h-px w-full dark:bg-white/15 bg-black/15"></div>

                        <!-- ITEM 2 -->
                        <div class="flex items-start gap-4 py-10">
                            <!-- Icon -->
                            <div class="mt-1 text-blue-700">
                                <!-- Docs + Magnifier -->
                                <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M16 14h22v30H16V14Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M26 20h8" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M22 28h12" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M40 22h8v16h-8" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <circle cx="44" cy="44" r="7" stroke="currentColor"
                                        stroke-width="3" />
                                    <path d="M49 49l6 6" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                </svg>
                            </div>

                            <!-- Text -->
                            <div class="min-w-0">
                                <h3 class="text-sm font-extrabold dark:text-white text-black">
                                    Documentation
                                </h3>

                                <p class="mt-2 text-sm leading-6 dark:text-white/55 text-black/55">
                                    SRS / FSD / BRD / Blueprint document (if not finished completely
                                    in 3 months, the contract will be extended, but development could
                                    be started based on the finished blueprint and the blueprint will
                                    consist of minimum 2 - 3 milestones or months of development)
                                </p>

                                <!-- Bullet list -->
                                <ul
                                    class="mt-6 list-disc space-y-3 pl-5 text-sm leading-6 dark:text-white/55 text-black/55">
                                    <li>
                                        Will adapt BPMN 2.0 but not all of them will be implemented,
                                        just a few that Yada Ekidana classify as important for development process
                                        based on Yada Ekidana' experiences
                                    </li>
                                    <li>Flowchart for all business processes</li>
                                    <li>User Stories / Use Cases (detail explanation of flowcharts)</li>
                                    <li>State Diagram for every User Stories / Use Cases</li>
                                    <li>Activity Diagram for every User Stories / Use Cases</li>
                                    <li>ERD / database design</li>
                                    <li>Class diagram</li>
                                    <li>UI/UX storyboard</li>
                                    <li>Mock-up and/or design</li>
                                    <li>Traceable Matrix (if needed)</li>
                                    <li>Priority of development or Roadmap (if needed)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="h-px w-full dark:bg-white/15 bg-black/15"></div>

                        <!-- ITEM 3 -->
                        <div class="flex items-start gap-4 pt-10">
                            <!-- Icon -->
                            <div class="mt-1 text-blue-700">
                                <!-- Page -->
                                <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                    <path d="M18 10h28v44H18V10Z" stroke="currentColor" stroke-width="3" />
                                    <path d="M24 22h16" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M24 30h12" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                    <path d="M24 38h16" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" />
                                </svg>
                            </div>

                            <!-- Text -->
                            <div class="min-w-0">
                                <h3 class="text-sm font-extrabold dark:text-white text-black">
                                    BAST
                                </h3>
                                <p class="mt-2 text-sm leading-6 dark:text-white/55 text-black/55">
                                    BAST for every module
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /RIGHT -->
                </div>
            </div>
        </section>
    </div>
    <div class="relative isolate">
        <section class="dark:bg-black bg-white py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-14 lg:grid-cols-[520px_1fr] lg:items-start">
                    <!-- LEFT -->
                    <div>
                        <div class="h-[2px] w-full max-w-[460px] dark:bg-white/35 bg-black/35"></div>

                        <h2 class="mt-8 text-4xl font-extrabold leading-tight dark:text-white text-black">
                            Team Members <br />
                            on Technical Writer
                        </h2>

                        <p class="mt-4 max-w-md text-sm leading-6 dark:text-white/55 text-black/55">
                            The team may consist of software developers, designers, business analysts-
                            in essence, people with all of the skills required to bring the project to fruition.
                        </p>
                    </div>

                    <!-- RIGHT -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="w-full max-w-[560px]">
                            <div class="grid grid-cols-3">
                                <!-- ROW 1 -->
                                <div
                                    class="flex flex-col items-center gap-2 border-b dark:border-white/15 border-black/15 py-6">
                                    <div class="text-blue-700">
                                        <!-- icon -->
                                        <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                            aria-hidden="true">
                                            <circle cx="22" cy="20" r="7" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M10 50c1-10 7-16 12-16s11 6 12 16" stroke="currentColor"
                                                stroke-width="3" stroke-linecap="round" />
                                            <circle cx="44" cy="22" r="8" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M42 22l2 2 5-5" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold text-black/70">Business Analyst</div>
                                </div>

                                <div
                                    class="flex flex-col items-center gap-2 border-b dark:border-white/15 border-black/15 border-l py-6">
                                    <div class="text-blue-700">
                                        <!-- icon -->
                                        <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                            aria-hidden="true">
                                            <circle cx="22" cy="20" r="7" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M10 50c1-10 7-16 12-16s11 6 12 16" stroke="currentColor"
                                                stroke-width="3" stroke-linecap="round" />
                                            <circle cx="44" cy="22" r="8" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M40 26l8-8" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                            <path d="M38 24l6 6" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold text-black/70">Designer</div>
                                </div>

                                <div
                                    class="flex flex-col items-center gap-2 border-b dark:border-white/15 border-black/15 border-l py-6">
                                    <div class="text-blue-700">
                                        <!-- icon -->
                                        <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                            aria-hidden="true">
                                            <circle cx="22" cy="20" r="7" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M10 50c1-10 7-16 12-16s11 6 12 16" stroke="currentColor"
                                                stroke-width="3" stroke-linecap="round" />
                                            <circle cx="44" cy="22" r="8" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M44 18v8" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                            <path d="M40 22h8" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold dark:text-white/70 text-black/70">Project
                                        Coordinator</div>
                                </div>

                                <!-- ROW 2 -->
                                <div class="col-span-1 flex flex-col items-center gap-2 py-6">
                                    <div class="text-blue-700">
                                        <!-- icon -->
                                        <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                            aria-hidden="true">
                                            <circle cx="22" cy="20" r="7" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M10 50c1-10 7-16 12-16s11 6 12 16" stroke="currentColor"
                                                stroke-width="3" stroke-linecap="round" />
                                            <circle cx="44" cy="22" r="8" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M40 20l8 4-8 4" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold dark:text-white/70 text-black/70">Lead Developer
                                    </div>
                                </div>

                                <div
                                    class="col-span-1 flex flex-col items-center gap-2 border-l dark:border-white/15 border-black/15 py-6">
                                    <div class="text-blue-700">
                                        <!-- icon -->
                                        <svg class="h-10 w-10" viewBox="0 0 64 64" fill="none"
                                            aria-hidden="true">
                                            <circle cx="22" cy="20" r="7" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M10 50c1-10 7-16 12-16s11 6 12 16" stroke="currentColor"
                                                stroke-width="3" stroke-linecap="round" />
                                            <circle cx="44" cy="22" r="8" stroke="currentColor"
                                                stroke-width="3" />
                                            <path d="M40 22h8" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                            <path d="M44 18v8" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold dark:text-white/70 text-black/70">QA Officer
                                    </div>
                                </div>

                                <!-- kosong supaya layout sama (3 kolom) -->
                                <div class="col-span-1"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /RIGHT -->
                </div>
            </div>
        </section>
    </div>
    <div class="relative isolate">
        <section class="dark:bg-black bg-white py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <!-- TOP LINE + TITLE -->
                <div class="max-w-3xl">
                    <div class="h-[2px] w-full max-w-[520px] bg-black/35"></div>

                    <h2 class="mt-8 text-5xl font-extrabold leading-[1.05] dark:text-white text-black">
                        Workflow for <br />
                        Technical Writer
                    </h2>
                </div>

                <!-- BLUE PHASE BAR -->
                <div class="mt-10">
                    <div class="relative grid grid-cols-2 overflow-hidden">
                        <!-- LEFT -->
                        <div class="relative flex items-center justify-center bg-blue-700 py-5">
                            <span class="text-sm font-semibold dark:text-white text-white">Client</span>
                            <div class="absolute right-0 top-0 h-full w-12 bg-white"
                                style="clip-path: polygon(0 0, 100% 50%, 0 100%, 0 0)" aria-hidden="true"></div>
                        </div>

                        <!-- RIGHT -->
                        <div class="relative flex items-center justify-center bg-blue-700 py-5">
                            <div class="absolute left-0 top-0 h-full w-14 bg-white"
                                style="clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 50%)" aria-hidden="true"></div>
                            <span class="text-sm font-semibold dark:text-white text-white">
                                Execution Solution Phase
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DIAGRAM (SVG) -->
                <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-black">
                    <svg viewBox="0 0 1200 520" class="h-auto w-full dark:text-white text-black"
                        xmlns="http://www.w3.org/2000/svg" aria-label="Workflow Diagram">
                        <!-- defs only for arrow marker -->
                        <defs>
                            <marker id="arrow" viewBox="0 0 10 10" refX="9" refY="5"
                                markerWidth="8" markerHeight="8" orient="auto-start-reverse">
                                <path d="M0 0 L10 5 L0 10 Z" fill="#0B33FF" />
                            </marker>
                        </defs>

                        <!-- ===================== -->
                        <!-- LEFT AXIS LABELS -->
                        <!-- ===================== -->
                        <text x="85" y="190" transform="rotate(-90 85 190)" font-size="14"
                            font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                            fill="currentColor">
                            Abstract
                        </text>

                        <text x="85" y="390" transform="rotate(-90 85 390)" font-size="14"
                            font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                            fill="currentColor">
                            Concrete
                        </text>

                        <!-- ===================== -->
                        <!-- LEFT MINI FLOW -->
                        <!-- ===================== -->

                        <!-- flag -->
                        <g transform="translate(140,360)">
                            <path d="M18 8 V44" stroke="#0B33FF" stroke-width="3" fill="none" />
                            <path d="M18 10 C26 4 32 16 40 10 V26 C32 32 26 20 18 26 Z" stroke="#0B33FF"
                                stroke-width="3" fill="none" />
                        </g>

                        <!-- arrow flag -> empathize -->
                        <path d="M170 390 H255" stroke="#0B33FF" stroke-width="2" fill="none"
                            marker-end="url(#arrow)" transform="translate(20,-13)" />

                        <!-- empathize icon -->
                        <g transform="translate(250,360)">
                            <path
                                d="M14 24 C14 16 24 16 24 24 C24 16 34 16 34 24 C34 34 24 40 24 40 C24 40 14 34 14 24 Z"
                                stroke="#0B33FF" stroke-width="3" fill="none" transform="translate(27,-10)" />

                            <text x="25" y="50" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Empathize
                            </text>
                        </g>

                        <!-- arrow empathize -> define -->
                        <path d="M301 355 V310" stroke="#0B33FF" stroke-width="2" fill="none"
                            marker-end="url(#arrow)" transform="translate(0,0)" />

                        <!-- define icon -->
                        <g transform="translate(275,255)">
                            <path d="M16 34 L26 24 L36 34" stroke="#0B33FF" stroke-width="3" fill="none" />
                            <path d="M26 14 V34" stroke="#0B33FF" stroke-width="3" fill="none" />
                            <text x="7" y="50" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Define
                            </text>
                        </g>

                        <!-- arrow define -> ideate -->
                        <path d="M301 245 V200" stroke="#0B33FF" stroke-width="2" fill="none"
                            marker-end="url(#arrow)" transform="translate(0,20)" />

                        <!-- ideate icon (bulb) -->
                        <g transform="translate(275,140)">
                            <path d="M18 28 C18 16 34 16 34 28 C34 35 30 37 30 44 H22 C22 37 18 35 18 28 Z"
                                stroke="#0B33FF" stroke-width="3" fill="none" />
                            <path d="M23 46 H29" stroke="#0B33FF" stroke-width="3" fill="none" />
                            <text x="9" y="60" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Ideate
                            </text>
                        </g>

                        <!-- arrow ideate -> try experiment (right angle like image)-->
                        <path d="M330 195 H385 V245 H440" stroke="#0B33FF" stroke-width="2" fill="none"
                            marker-end="url(#arrow)" />
                        <text x="420" y="270" font-size="12"
                            font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                            fill="currentColor">
                            Try Experiment
                        </text>

                        <!-- ===================== -->
                        <!-- CENTER: LEAN STARTUP LOOP -->
                        <!-- ===================== -->
                        <g transform="translate(600,245)">
                            <!-- thick soft loop background -->
                            <circle r="145" stroke="rgba(17,17,17,.08)" stroke-width="18" fill="none" />

                            <!-- 4 arcs with arrows -->
                            <path d="M0 -145 A145 145 0 0 1 132 -45" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" />
                            <path d="M122 45 A145 135 0 0 1 0 135" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" transform="translate(10,10)" />
                            <path d="M0 145 A145 145 0 0 1 -132 45" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" />
                            <path d="M-125 -60 A145 145 0 0 1 0 -145" stroke="#0B33FF" stroke-width="2"
                                fill="none" marker-end="url(#arrow)" transform="translate(-10,0)" />

                            <!-- text labels -->
                            <text x="-20" y="-78" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Learn
                            </text>

                            <text x="40" y="70" transform="rotate(-40 100 30)" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Build
                            </text>

                            <text x="-35" y="116" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Measure
                            </text>

                            <text x="-22" y="10" font-size="12" font-weight="700"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="#0B33FF">
                                ITERATE
                            </text>

                            <text x="-75" y="40" font-size="10"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Pivot/ Persevere?
                            </text>

                            <!-- top icon -->
                            <g transform="translate(-5,-120)">
                                <circle cx="0" cy="-10" r="6" stroke="#0B33FF" stroke-width="3"
                                    fill="none" />
                                <path d="M-12 10 C-8 0 8 0 12 10" stroke="#0B33FF" stroke-width="3" fill="none" />
                                <path d="M-10 10 V26" stroke="#0B33FF" stroke-width="3" fill="none" />
                                <path d="M10 10 V26" stroke="#0B33FF" stroke-width="3" fill="none" />
                            </g>

                            <!-- infinity scribble -->
                            {{-- <path d="M-35 85 C-15 55 15 115 35 85 C55 55 85 115 105 85" stroke="#0B33FF"
                                stroke-width="4" fill="none" opacity="0.9" /> --}}
                        </g>

                        <!-- arrow center -> right loop -->
                        <path d="M750 245 H820" stroke="#0B33FF" stroke-width="2" fill="none"
                            marker-end="url(#arrow)" />

                        <!-- ===================== -->
                        <!-- RIGHT: AGILE LOOP -->
                        <!-- ===================== -->
                        <g transform="translate(970,245)">
                            <circle r="145" stroke="rgba(17,17,17,.08)" stroke-width="18" fill="none" />

                            <!-- arrows around (arah dibalik: menuju ke Product Backlog) -->
                            <!-- atas -> kiri (menuju Product Backlog) -->
                            <path d="M0 -145 A145 145 0 0 0 -125 -70" stroke="#0B33FF" stroke-width="2"
                                fill="none" marker-end="url(#arrow)" />

                            <!-- kiri -> bawah -->
                            <path d="M-145 0 A145 145 0 0 0 -70 125" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" />

                            <!-- bawah -> kanan -->
                            <path d="M0 145 A145 145 0 0 0 125 70" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" />

                            <!-- kanan -> atas -->
                            <path d="M145 0 A145 145 0 0 0 70 -125" stroke="#0B33FF" stroke-width="2" fill="none"
                                marker-end="url(#arrow)" />


                            <!-- labels -->
                            <text x="-0" y="-122" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Sprint
                            </text>
                            <text x="-0" y="-102" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Planning
                            </text>

                            <text x="125" y="45" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Sprint
                            </text>
                            <text x="120" y="60" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Execution
                            </text>

                            <text x="-65" y="122" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Shippable
                            </text>
                            <text x="-55" y="142" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Increment
                            </text>

                            <text x="-178" y="42" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Sprint
                            </text>
                            <text x="-178" y="62" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Review
                            </text>

                            <text x="-142" y="-18" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Product
                            </text>
                            <text x="-142" y="2" font-size="12"
                                font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                                fill="currentColor">
                                Backlog
                            </text>

                            <!-- mini icons -->
                            <g transform="translate(-150,-72)">
                                <rect x="0" y="0" width="26" height="18" fill="none" stroke="#0B33FF"
                                    stroke-width="3" />
                                <path d="M4 6 H22" stroke="#0B33FF" stroke-width="3" />
                                <rect x="0" y="24" width="26" height="18" fill="none" stroke="#0B33FF"
                                    stroke-width="3" />
                            </g>

                            <g transform="translate(5,-160)">
                                <rect x="0" y="0" width="26" height="18" fill="none" stroke="#0B33FF"
                                    stroke-width="3" />
                                <path d="M6 6 H20" stroke="#0B33FF" stroke-width="3" />
                                <path d="M6 12 H16" stroke="#0B33FF" stroke-width="3" />
                            </g>

                            <g transform="translate(130,-1)">
                                <rect x="0" y="0" width="22" height="28" fill="none" stroke="#0B33FF"
                                    stroke-width="3" />
                                <path d="M6 8 H16" stroke="#0B33FF" stroke-width="3" />
                                <path d="M6 14 H18" stroke="#0B33FF" stroke-width="3" />
                            </g>

                            <g transform="translate(-40,150)">
                                <rect x="0" y="0" width="26" height="30" fill="none" stroke="#0B33FF"
                                    stroke-width="3" />
                                <path d="M0 6 H26" stroke="#0B33FF" stroke-width="3" />
                            </g>
                        </g>

                        <!-- ===================== -->
                        <!-- BOTTOM LABELS -->
                        <!-- ===================== -->
                        <text x="230" y="500" font-size="12"
                            font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                            fill="currentColor">
                            Customer Problem
                        </text>

                        <text x="680" y="500" font-size="12"
                            font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial"
                            fill="currentColor">
                            Customer Solution
                        </text>
                    </svg>
                </div>

            </div>
        </section>
    </div>
    {{-- <livewire:web.shared.case-studies /> --}}
    <livewire:web.shared.cta />
</x-layouts.web>
