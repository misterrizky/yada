<section class="w-full max-w-6xl">
    <div class="w-full overflow-x-auto">
        <!-- 1:1 mengikuti gambar (1069 x 415) -->
        <svg viewBox="0 0 1069 415" class="w-full h-auto min-w-[980px]" aria-label="Project type managed services diagram"
            role="img">
            <defs>
                <style>
                    .b {
                        stroke: #0b2ce8;
                    }

                    .t {
                        stroke: #22b8d8;
                    }

                    .blueFill {
                        fill: #0b2ce8;
                    }

                    .tealFill {
                        fill: #22b8d8;
                    }

                    .halo {
                        fill: #e9edff;
                    }

                    .txt {
                        fill: #0f172a;
                        font-weight: 800;
                        font-size: 14px;
                    }

                    .muted {
                        fill: #8a8a94;
                        font-weight: 700;
                        font-size: 13px;
                    }

                    .line {
                        fill: none;
                        stroke-width: 2.5;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }
                </style>

                <marker id="arrowBlue" markerWidth="12" markerHeight="12" refX="10" refY="6" orient="auto">
                    <path d="M0,0 L12,6 L0,12 Z" fill="#0b2ce8" />
                </marker>

                <filter id="softHalo" x="-60%" y="-60%" width="220%" height="220%">
                    <feGaussianBlur stdDeviation="1.2" />
                </filter>
            </defs>

            <!-- ===================== -->
            <!-- CONNECTORS (behind)   -->
            <!-- ===================== -->

            <!-- End User <-> Client PIC -->
            <!-- top (Client PIC -> End User) -->
            <path d="M300 170 H120" class="line b" marker-end="url(#arrowBlue)" />
            <text x="210" y="162" text-anchor="middle" class="muted">Rep</text>

            <!-- bottom (End User -> Client PIC) -->
            <path d="M120 200 H300" class="line b" marker-end="url(#arrowBlue)" />
            <text x="210" y="214" text-anchor="middle" class="muted">Solutions</text>

            <!-- Client PIC -> PM Tools (Check Ticket Status) : up then right -->
            <path d="M351 118 V55 H475" class="line b" marker-end="url(#arrowBlue)" />
            <text x="410" y="36" text-anchor="middle" class="muted">Check Ticket Status</text>

            <!-- PM Tools <-> Bug Fixing (top two lines) -->
            <!-- Ticket Done (right -> left) -->
            <path d="M980 38 H545" class="line b" marker-end="url(#arrowBlue)" />
            <text x="760" y="22" text-anchor="middle" class="muted">Ticket Done</text>

            <!-- Receive Ticket (left -> right) -->
            <path d="M545 62 H980" class="line b" marker-end="url(#arrowBlue)" />
            <text x="760" y="86" text-anchor="middle" class="muted">Receive Ticket</text>

            <!-- Create Ticket (Bugs/Flow up then left to PM Tools) -->
            <path d="M1030 242 V128 H545" class="line b" marker-end="url(#arrowBlue)" />
            <text x="770" y="165" text-anchor="middle" class="muted">Create Ticket</text>

            <!-- YE Chat -> Customer Care (Receive Ticket) : from bottom up then right -->
            <path d="M520 320 V175 H612" class="line b" marker-end="url(#arrowBlue)" />
            <text x="580" y="162" text-anchor="middle" class="muted">Receive Ticket</text>

            <!-- Customer Care -> Support Team -> Bugs/Flow -->
            <path d="M682 206 H830" class="line b" marker-end="url(#arrowBlue)" />
            <path d="M900 206 H995" class="line b" marker-end="url(#arrowBlue)" />

            <!-- Bugs/Flow -> YE Chat (Inform Application's flow/bugs) : down then left -->
            <path d="M1030 242 V345 H520" class="line b" marker-end="url(#arrowBlue)" />
            <text x="770" y="365" text-anchor="middle" class="muted">
                Inform Application's flow/bugs
            </text>

            <!-- Client PIC -> YE Chat (Report) : down then right -->
            <path d="M351 250 V330 H440" class="line b" marker-end="url(#arrowBlue)" />
            <text x="305" y="360" text-anchor="middle" class="muted">Report</text>

            <!-- ===================== -->
            <!-- NODES + ICONS          -->
            <!-- ===================== -->

            <!-- End User (big blue with halo) -->
            <g>
                <circle cx="65" cy="184" r="78" class="halo" filter="url(#softHalo)" />
                <circle cx="65" cy="184" r="66" class="blueFill" />
                <!-- user icon -->
                <g transform="translate(65 184)" fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="0" cy="-18" r="12" />
                    <path d="M-26 22c6-18 16-26 26-26s20 8 26 26" />
                    <path d="M0 -2 L-10 10 L0 30 L10 10 Z" fill="#fff" stroke="none" />
                </g>
                <text x="65" y="310" text-anchor="middle" class="txt">End User</text>
            </g>

            <!-- Client PIC (big blue with halo) -->
            <g>
                <circle cx="351" cy="184" r="78" class="halo" filter="url(#softHalo)" />
                <circle cx="351" cy="184" r="66" class="blueFill" />
                <!-- user icon -->
                <g transform="translate(351 184)" fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="0" cy="-18" r="12" />
                    <path d="M-26 22c6-18 16-26 26-26s20 8 26 26" />
                    <path d="M0 -2 L-10 10 L0 30 L10 10 Z" fill="#fff" stroke="none" />
                </g>
                <text x="351" y="310" text-anchor="middle" class="txt">Client PIC</text>
            </g>

            <!-- PM Tools (clipboard + pencil) -->
            <g transform="translate(500 30)">
                <g transform="translate(0 0)" fill="none" stroke="#0b2ce8" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round">
                    <!-- clipboard -->
                    <path d="M10 18h34v44H10z" />
                    <path d="M18 18v-8h18v8" />
                    <path d="M18 34h18M18 46h18" opacity="0.9" />
                    <!-- pencil -->
                    <path d="M44 16l10 10" />
                    <path d="M40 20l12-12 10 10-12 12" />
                </g>
                <text x="28" y="94" text-anchor="middle" class="txt">PM Tools</text>
            </g>

            <!-- Bug Fixing (monitor + gear-ish) -->
            <g transform="translate(980 20)">
                <g fill="none" stroke="#0b2ce8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="0" y="0" width="52" height="40" rx="4" />
                    <path d="M10 46h32" />
                    <!-- small gear -->
                    <circle cx="26" cy="22" r="8" />
                    <path d="M26 8v6M26 30v6M12 22h6M34 22h6" />
                    <path d="M16 12l4 4M36 32l4 4M36 12l-4 4M16 32l4-4" />
                </g>
                <text x="26" y="78" text-anchor="middle" class="txt">Bug Fixing</text>
            </g>

            <!-- Customer Care YE (teal) -->
            <g>
                <circle cx="647" cy="206" r="35" class="tealFill" />
                <g transform="translate(647 206)" fill="none" stroke="#fff" stroke-width="4.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="0" cy="-10" r="9" />
                    <path d="M-18 20c4-12 12-18 18-18s14 6 18 18" />
                </g>
                <text x="647" y="272" text-anchor="middle" class="txt">Customer Care</text>
                <text x="647" y="290" text-anchor="middle" class="txt">YE</text>
            </g>

            <!-- Support Team (teal) -->
            <g>
                <circle cx="865" cy="206" r="35" class="tealFill" />
                <g transform="translate(865 206)" fill="none" stroke="#fff" stroke-width="4.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="0" cy="-10" r="9" />
                    <path d="M-18 20c4-12 12-18 18-18s14 6 18 18" />
                </g>
                <text x="865" y="272" text-anchor="middle" class="txt">Support</text>
                <text x="865" y="290" text-anchor="middle" class="txt">Team</text>
            </g>

            <!-- Bugs / Flow (bug icon) -->
            <g transform="translate(1006 182)">
                <g fill="none" stroke="#0b2ce8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M24 10c10 0 18 8 18 18s-8 18-18 18S6 38 6 28 14 10 24 10Z" />
                    <path d="M24 6v6" />
                    <path d="M12 22H4M44 22h-8" />
                    <path d="M12 34H6M42 34h-6" />
                    <path d="M14 14l-6-6M34 14l6-6" />
                    <path d="M16 26h16" />
                </g>
                <text x="24" y="78" text-anchor="middle" class="txt">Bugs / Flow</text>
            </g>

            <!-- YE Chat (person + bubble outline) -->
            <g transform="translate(470 320)">
                <g fill="none" stroke="#0b2ce8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                    <!-- head -->
                    <circle cx="30" cy="22" r="10" />
                    <!-- shoulders -->
                    <path d="M12 60c5-14 14-22 18-22s13 8 18 22" />
                    <!-- chat bubble -->
                    <path d="M52 14h36v24H68l-6 6v-6H52z" />
                </g>
                <text x="50" y="92" text-anchor="middle" class="txt">YE Chat</text>
            </g>
        </svg>
    </div>
</section>
