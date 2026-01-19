<section class="w-full max-w-4xl">
    <!-- responsive; kalau layar kecil bisa scroll sedikit -->
    <div class="w-full overflow-x-auto">
        <!-- 1:1 dengan gambar (658 x 110) -->
        <svg viewBox="0 0 658 110" class="w-full h-auto min-w-[658px]" aria-label="Software development flow"
            role="img">
            <defs>
                <style>
                    .blueFill {
                        fill: #072fe0;
                    }

                    .blueStroke {
                        stroke: #072fe0;
                    }

                    .tealStroke {
                        stroke: #27bbd2;
                    }

                    .halo {
                        fill: #e9edff;
                    }

                    .label {
                        fill: #8a8a94;
                        font-size: 20px;
                        font-weight: 700;
                    }

                    .num {
                        fill: #ffffff;
                        font-size: 14px;
                        font-weight: 800;
                    }
                </style>

                <filter id="softHalo" x="-60%" y="-60%" width="220%" height="220%">
                    <feGaussianBlur stdDeviation="0.6" />
                </filter>
            </defs>

            <!-- ===================== -->
            <!-- VERTICAL TEAL LINES   -->
            <!-- ===================== -->
            <!-- node centers (x): 23,103,188,274,362,446,531,613 ; y=55 -->
            <!-- top lines (1,3,5,7) -->
            <line x1="23" y1="0" x2="23" y2="39" class="tealStroke" stroke-width="4" />
            <line x1="188" y1="0" x2="188" y2="39" class="tealStroke" stroke-width="4" />
            <line x1="362" y1="0" x2="362" y2="39" class="tealStroke" stroke-width="4" />
            <line x1="531" y1="0" x2="531" y2="39" class="tealStroke" stroke-width="4" />

            <!-- bottom lines (2,4,6,8) -->
            <line x1="103" y1="71" x2="103" y2="110" class="tealStroke" stroke-width="4" />
            <line x1="274" y1="71" x2="274" y2="110" class="tealStroke" stroke-width="4" />
            <line x1="446" y1="71" x2="446" y2="110" class="tealStroke" stroke-width="4" />
            <line x1="613" y1="71" x2="613" y2="110" class="tealStroke" stroke-width="4" />

            <!-- ===================== -->
            <!-- LABELS                -->
            <!-- ===================== -->
            <!-- top -->
            <text x="36" y="22" class="label">Development</text>
            <text x="201" y="22" class="label">Final Demo</text>
            <text x="375" y="22" class="label">Training</text>
            <text x="544" y="22" class="label">Finishing</text>

            <!-- bottom -->
            <text x="116" y="103" class="label">Proofing</text>
            <text x="287" y="103" class="label">Deployment</text>
            <text x="459" y="103" class="label">Simulation</text>
            <text x="626" y="103" class="label">UAT</text>

            <!-- ===================== -->
            <!-- HORIZONTAL ARROWS     -->
            <!-- ===================== -->
            <!-- config -->
            <!-- y=55, node r=14, arrowLen=12 -->
            <!-- segment = line + triangle -->
            <!-- 1 -> 2 -->
            <line x1="37" y1="55" x2="65" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="77,55 65,49 65,61" />
            <!-- 2 -> 3 -->
            <line x1="117" y1="55" x2="150" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="162,55 150,49 150,61" />
            <!-- 3 -> 4 -->
            <line x1="202" y1="55" x2="236" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="248,55 236,49 236,61" />
            <!-- 4 -> 5 -->
            <line x1="288" y1="55" x2="324" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="336,55 324,49 324,61" />
            <!-- 5 -> 6 -->
            <line x1="376" y1="55" x2="408" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="420,55 408,49 408,61" />
            <!-- 6 -> 7 -->
            <line x1="460" y1="55" x2="494" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="506,55 494,49 494,61" />
            <!-- 7 -> 8 -->
            <line x1="545" y1="55" x2="576" y2="55" class="blueStroke" stroke-width="4"
                stroke-linecap="round" />
            <polygon class="blueFill" points="588,55 576,49 576,61" />

            <!-- ===================== -->
            <!-- NODES (HALO + CIRCLE) -->
            <!-- ===================== -->
            <!-- halo -->
            <g filter="url(#softHalo)">
                <circle cx="23" cy="55" r="22" class="halo" />
                <circle cx="103" cy="55" r="22" class="halo" />
                <circle cx="188" cy="55" r="22" class="halo" />
                <circle cx="274" cy="55" r="22" class="halo" />
                <circle cx="362" cy="55" r="22" class="halo" />
                <circle cx="446" cy="55" r="22" class="halo" />
                <circle cx="531" cy="55" r="22" class="halo" />
                <circle cx="613" cy="55" r="22" class="halo" />
            </g>

            <!-- solid circles -->
            <circle cx="23" cy="55" r="14" class="blueFill" />
            <circle cx="103" cy="55" r="14" class="blueFill" />
            <circle cx="188" cy="55" r="14" class="blueFill" />
            <circle cx="274" cy="55" r="14" class="blueFill" />
            <circle cx="362" cy="55" r="14" class="blueFill" />
            <circle cx="446" cy="55" r="14" class="blueFill" />
            <circle cx="531" cy="55" r="14" class="blueFill" />
            <circle cx="613" cy="55" r="14" class="blueFill" />

            <!-- numbers -->
            <g text-anchor="middle" dominant-baseline="middle" class="num">
                <text x="23" y="55">1</text>
                <text x="103" y="55">2</text>
                <text x="188" y="55">3</text>
                <text x="274" y="55">4</text>
                <text x="362" y="55">5</text>
                <text x="446" y="55">6</text>
                <text x="531" y="55">7</text>
                <text x="613" y="55">8</text>
            </g>
        </svg>
    </div>
</section>
