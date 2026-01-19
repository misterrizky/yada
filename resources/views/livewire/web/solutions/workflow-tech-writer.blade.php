<section class="w-full max-w-[1200px]">
    <div class="w-full overflow-x-auto">
        <!-- Match image aspect: 1115 x 557 -->
        <svg viewBox="0 0 1115 557" class="w-full h-auto min-w-[980px]" aria-label="Dual loop diagram" role="img">
            <defs>
                <style>
                    .blue {
                        stroke: #0b2ce8;
                    }

                    .blueFill {
                        fill: #0b2ce8;
                    }

                    .ring {
                        stroke: #e9edf6;
                    }

                    .muted {
                        fill: #6b7280;
                    }

                    .soft {
                        stroke: #eef2ff;
                    }

                    .label {
                        fill: #0f172a;
                        font-weight: 700;
                        font-size: 14px;
                    }

                    .label2 {
                        fill: #0f172a;
                        font-weight: 700;
                        font-size: 13px;
                    }

                    .small {
                        fill: #374151;
                        font-weight: 600;
                        font-size: 13px;
                    }

                    .axis {
                        fill: #0b2ce8;
                        font-weight: 800;
                        font-size: 18px;
                    }

                    .base {
                        fill: #9ca3af;
                        font-weight: 500;
                        font-size: 16px;
                    }
                </style>

                <marker id="arrow" markerWidth="10" markerHeight="10" refX="9" refY="5" orient="auto">
                    <path d="M0,0 L10,5 L0,10 Z" fill="#0b2ce8" />
                </marker>

                <filter id="halo" x="-60%" y="-60%" width="220%" height="220%">
                    <feGaussianBlur stdDeviation="1.2" />
                </filter>
            </defs>

            <!-- faint grid lines like image -->
            <line x1="0" y1="275" x2="1115" y2="275" stroke="#eef2f7" stroke-width="1" />
            <line x1="360" y1="0" x2="360" y2="557" stroke="#eef2f7" stroke-width="1" />

            <!-- LEFT AXIS LABELS -->
            <text x="35" y="170" class="axis" transform="rotate(-90 35 170)">Abstract</text>
            <text x="35" y="395" class="axis" transform="rotate(-90 35 395)">Concrete</text>

            <!-- ========================= -->
            <!-- LEFT: Design thinking path -->
            <!-- ========================= -->

            <!-- Flag icon (left) -->
            <g transform="translate(145 355)" fill="none" stroke="#0b2ce8" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M0 0v44" />
                <path d="M0 4h18l6 6h18v18H24l-6-6H0" />
            </g>

            <!-- Arrow flag -> empathize -->
            <path d="M205 377 H305" fill="none" stroke="#0b2ce8" stroke-width="2.5" marker-end="url(#arrow)" />

            <!-- Empathize icon -->
            <g transform="translate(320 360)" fill="none" stroke="#0b2ce8" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round">
                <!-- hand -->
                <path d="M0 28c12 0 20-8 26-16l10 10c-6 10-18 20-36 20h0c-10 0-18-6-18-14V8" />
                <path d="M-18 8h8c4 0 6 3 6 6v10" />
                <!-- heart -->
                <path d="M34 6c3-4 10-4 13 1c3 5-1 11-13 18c-12-7-16-13-13-18c3-5 10-5 13-1Z" />
            </g>
            <text x="345" y="455" text-anchor="middle" class="label">Empathize</text>

            <!-- Up arrows Empathize -> Define -> Ideate -->
            <path d="M345 345 V290" fill="none" stroke="#0b2ce8" stroke-width="2.5" marker-end="url(#arrow)" />
            <path d="M345 250 V195" fill="none" stroke="#0b2ce8" stroke-width="2.5" marker-end="url(#arrow)" />

            <!-- Define icon -->
            <g transform="translate(332 245)" fill="none" stroke="#0b2ce8" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M0 30c8-10 8-26 0-36" />
                <path d="M0 12h14" />
                <path d="M0 22h18" />
                <path d="M0 2h10" />
                <path d="M24 8l6-6M24 8l6 6" />
            </g>
            <text x="345" y="300" text-anchor="middle" class="label">Define</text>

            <!-- Ideate icon (bulb) -->
            <g transform="translate(345 150)" fill="none" stroke="#0b2ce8" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round">
                <path
                    d="M0 -24c-12 0-22 10-22 22c0 10 6 16 12 22c3 3 4 6 4 10h12c0-4 1-7 4-10c6-6 12-12 12-22c0-12-10-22-22-22Z" />
                <path d="M-10 34H10" />
                <path d="M-8 46H8" />
            </g>
            <text x="345" y="175" text-anchor="middle" class="label">Ideate</text>

            <!-- Bracket / turn to Try Experiment -->
            <path d="M395 160 H415 V215 H440" fill="none" stroke="#0b2ce8" stroke-width="2.5" />
            <path d="M440 215 H470" fill="none" stroke="#0b2ce8" stroke-width="2.5" marker-end="url(#arrow)" />

            <!-- ========================= -->
            <!-- CENTER: Dual Loops         -->
            <!-- ========================= -->

            <!-- Left loop ring -->
            <circle cx="630" cy="215" r="165" fill="none" class="ring" stroke-width="26" />
            <!-- Right loop ring -->
            <circle cx="875" cy="215" r="165" fill="none" class="ring" stroke-width="26" />

            <!-- Try Experiment (flask) on left edge of left loop -->
            <g transform="translate(470 220)" fill="none" stroke="#0b2ce8" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M10 0h24" />
                <path d="M18 0v18l-14 28c-2 4 1 8 6 8h24c5 0 8-4 6-8L26 18V0" />
                <path d="M12 28h28" />
            </g>
            <text x="515" y="255" text-anchor="middle" class="label2">Try Experiment</text>

            <!-- Learn icon (top of left loop) -->
            <g transform="translate(630 70)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M0 0c0-8 8-14 18-14s18 6 18 14" />
                <path d="M8 0v18c0 6 6 10 10 10s10-4 10-10V0" />
                <path d="M-16 10l16-8 16 8-16 8-16-8Z" />
                <path d="M-4 26h8" />
            </g>
            <text x="630" y="118" text-anchor="middle" class="label">Learn</text>

            <!-- LEFT LOOP arrows (Build-Measure-Learn) -->
            <!-- top-left arc -->
            <path d="M555 105 A165 165 0 0 1 610 70" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- top-right arc -->
            <path d="M700 105 A165 165 0 0 1 745 165" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- bottom-right arc -->
            <path d="M745 265 A165 165 0 0 1 670 345" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- bottom-left arc -->
            <path d="M590 350 A165 165 0 0 1 525 285" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />

            <!-- Labels inside left loop -->
            <text x="585" y="322" class="label2" transform="rotate(-35 585 322)">Measure</text>
            <text x="740" y="270" class="label2" transform="rotate(90 740 270)">Build</text>
            <text x="610" y="240" text-anchor="middle" class="small">Pivot/ Persevere?</text>

            <!-- ITERATE + swirl -->
            <text x="680" y="320" class="label2">ITERATE</text>
            <g transform="translate(680 340)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round">
                <path d="M0 20c0-10 8-18 18-18s18 8 18 18" />
                <path d="M40 22c0-8 6-14 14-14s14 6 14 14" />
            </g>

            <!-- Connector funnel between loops (small triangle look at overlap right edge of left loop) -->
            <path d="M747 210 l18 0 l-9 14 z" fill="#ffffff" stroke="#0b2ce8" stroke-width="2" />

            <!-- ========================= -->
            <!-- RIGHT LOOP (Scrum cycle)  -->
            <!-- ========================= -->

            <!-- Product Backlog icon (server) -->
            <g transform="translate(735 140)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="42" height="20" rx="3" />
                <rect x="0" y="26" width="42" height="20" rx="3" />
                <circle cx="8" cy="10" r="2" />
                <circle cx="8" cy="36" r="2" />
                <path d="M16 10h18M16 36h18" />
            </g>
            <text x="780" y="190" class="label2">Product</text>
            <text x="780" y="208" class="label2">Backlog</text>

            <!-- Sprint Planning icon (doc + magnifier) -->
            <g transform="translate(970 115)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M0 0h34l10 10v46H0z" />
                <path d="M34 0v10h10" />
                <circle cx="18" cy="28" r="9" />
                <path d="M25 35l10 10" />
            </g>
            <text x="1005" y="180" text-anchor="middle" class="label2">Sprint</text>
            <text x="1005" y="198" text-anchor="middle" class="label2">Planning</text>

            <!-- Sprint Execution icon (doc) -->
            <g transform="translate(1048 205)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M0 0h34l10 10v46H0z" />
                <path d="M34 0v10h10" />
                <path d="M8 24h26M8 34h26M8 44h18" />
            </g>
            <text x="1078" y="282" text-anchor="middle" class="label2">Sprint</text>
            <text x="1078" y="300" text-anchor="middle" class="label2">Execution</text>

            <!-- Shippable Increment icon (door) -->
            <g transform="translate(935 358)" fill="none" stroke="#0b2ce8" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="34" height="46" />
                <path d="M34 0h16v46H34" />
                <circle cx="12" cy="24" r="2" />
            </g>
            <text x="952" y="428" text-anchor="middle" class="label2">Shippable</text>
            <text x="952" y="446" text-anchor="middle" class="label2">Increment</text>

            <!-- Sprint Review label near bottom-left -->
            <text x="740" y="360" class="label2">Sprint</text>
            <text x="740" y="378" class="label2">Review</text>

            <!-- Right loop arrows (clockwise-ish like image) -->
            <!-- top arc (points left) -->
            <path d="M965 105 A165 165 0 0 0 805 130" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- right arc (down) -->
            <path d="M1040 205 A165 165 0 0 0 1025 315" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- bottom arc (right) -->
            <path d="M780 350 A165 165 0 0 0 930 390" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />
            <!-- left-bottom arc back toward overlap -->
            <path d="M760 315 A165 165 0 0 0 735 235" fill="none" class="blue" stroke-width="2.8"
                marker-end="url(#arrow)" />

            <!-- ========================= -->
            <!-- Bottom captions            -->
            <!-- ========================= -->
            <text x="220" y="545" text-anchor="middle" class="base">Customer Problem</text>
            <text x="720" y="545" text-anchor="middle" class="base">Customer Solution</text>
        </svg>
    </div>
</section>
