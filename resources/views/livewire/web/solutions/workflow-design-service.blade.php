<section class="w-full max-w-[1746px]">
    <div class="w-full overflow-x-auto">
        <svg viewBox="0 0 1746 898" class="w-full h-auto min-w-[1746px]" aria-label="Design thinking workflow diagram"
            role="img">
            <defs>
                <!-- colors (sampled close to the image) -->
                <style>
                    .bg {
                        fill: #000;
                    }

                    .arc {
                        stroke: #c9d6ea;
                        stroke-width: 4;
                        fill: none;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .label {
                        fill: #1f1f1f;
                        font-weight: 800;
                        font-size: 44px;
                    }

                    .outer {
                        stroke: #ffffff;
                        stroke-width: 30;
                        fill: none;
                    }

                    .outerShade {
                        stroke: #e9edf5;
                        stroke-width: 30;
                        fill: none;
                    }

                    .inner {
                        stroke: #0020f6;
                        stroke-width: 8;
                        fill: none;
                    }

                    .icon {
                        stroke: #0020f6;
                        stroke-width: 9;
                        fill: none;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .arrowBlue {
                        fill: #0020f6;
                    }

                    .connW {
                        stroke: #ffffff;
                        stroke-width: 34;
                        fill: none;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .connB {
                        stroke: #0020f6;
                        stroke-width: 8;
                        fill: none;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }
                </style>

                <!-- arrow marker for iteration arcs -->
                <marker id="mArc" markerWidth="16" markerHeight="16" refX="13" refY="8" orient="auto">
                    <path d="M0,0 L16,8 L0,16" fill="none" stroke="#c9d6ea" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </marker>
            </defs>

            <rect x="0" y="0" width="1746" height="898" class="bg" />

            <!-- ===================== -->
            <!-- TOP ITERATION ARCS     -->
            <!-- (drawn right->left so arrow points left) -->
            <!-- ===================== -->
            <!-- small arcs -->
            <path class="arc" marker-end="url(#mArc)" d="M 430 345 Q 300 210 175 345" />
            <path class="arc" marker-end="url(#mArc)" d="M 705 345 Q 575 210 450 345" />
            <path class="arc" marker-end="url(#mArc)" d="M 980 345 Q 850 210 725 345" />
            <path class="arc" marker-end="url(#mArc)" d="M 1260 345 Q 1120 210 995 345" />

            <!-- medium arc (Prototype -> Empathize) -->
            <path class="arc" marker-end="url(#mArc)" d="M 990 300 Q 560 60 150 300" />

            <!-- large arc (Implement -> Empathize) -->
            <path class="arc" marker-end="url(#mArc)" d="M 1605 290 Q 960 10 120 290" />

            <!-- ===================== -->
            <!-- LABELS (dark gray)     -->
            <!-- ===================== -->
            <g text-anchor="middle">
                <text class="label" x="162.6" y="472">Empathize</text>
                <text class="label" x="436.2" y="472">Define</text>
                <text class="label" x="709.8" y="472">Ideate</text>
                <text class="label" x="989.4" y="472">Prototype</text>
                <text class="label" x="1267.8" y="472">Test</text>
                <text class="label" x="1576.2" y="472">Implement</text>
            </g>

            <!-- ===================== -->
            <!-- CONNECTORS BETWEEN NODES (white band + inner blue stripe) -->
            <!-- placed slightly above center (like the original) -->
            <!-- ===================== -->
            <!-- helper: baseline for connectors -->
            <!-- start/end points use angle ~ -20° on each circle -->
            <!-- Empathize -> Define -->
            <path class="connW" d="M 273 575 Q 299 548 325 575 T 325 575 T 325 575" opacity="0" />
            <path class="connW" d="M 272 575 Q 300 540 326 575 T 326 575" />
            <path class="connB" d="M 272 575 Q 300 540 326 575 T 326 575" />

            <!-- Define -> Ideate -->
            <path class="connW" d="M 545 575 Q 573 540 599 575 T 599 575" />
            <path class="connB" d="M 545 575 Q 573 540 599 575 T 599 575" />

            <!-- Ideate -> Prototype -->
            <path class="connW" d="M 819 575 Q 847 540 873 575 T 873 575" />
            <path class="connB" d="M 819 575 Q 847 540 873 575 T 873 575" />

            <!-- Prototype -> Test -->
            <path class="connW" d="M 1099 575 Q 1127 540 1153 575 T 1153 575" />
            <path class="connB" d="M 1099 575 Q 1127 540 1153 575 T 1153 575" />

            <!-- Test -> Implement -->
            <path class="connW" d="M 1378 575 Q 1406 540 1432 575 T 1432 575" />
            <path class="connB" d="M 1378 575 Q 1406 540 1432 575 T 1432 575" />

            <!-- Implement tail (right end like original) -->
            <path class="connW" d="M 1688 585
                 C 1730 660 1735 720 1712 740
                 L 1742 668" />
            <path class="connB" d="M 1688 585
                 C 1730 660 1735 720 1712 740
                 L 1742 668" />

            <!-- ===================== -->
            <!-- NODES (outer ring + shaded wedge + inner dashed ring) -->
            <!-- centers measured close to the original image -->
            <!-- ===================== -->
            <!-- constants: r=118 (outer edge ~133 with stroke 30), inner r=94 -->
            <!-- dashed ring: mostly full with small gap around the connector wedge -->
            <!-- dash values for r=94: circumference ~ 590 -->
            <!-- ===================== -->

            <!-- ===== Node 1: Empathize ===== -->
            <g>
                <circle cx="162.6" cy="613.8" r="118" class="outer" />
                <!-- light wedge on top-right -->
                <path class="outerShade" d="M 280 602 A 118 118 0 0 1 248 517" />
                <!-- inner ring -->
                <circle cx="162.6" cy="613.8" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />

                <!-- blue direction arrow on ring (bottom-right) -->
                <g transform="translate(0 0)">
                    <polygon class="arrowBlue" points="250,675 232,665 238,686" />
                </g>

                <!-- icon: person + heart -->
                <g transform="translate(162.6 613.8)" class="icon">
                    <circle cx="0" cy="-36" r="18" />
                    <!-- heart -->
                    <path d="M 0 10
                     C -18 -6 -44 2 -40 28
                     C -36 54 -8 66 0 76
                     C 8 66 36 54 40 28
                     C 44 2 18 -6 0 10" />
                </g>
            </g>

            <!-- ===== Node 2: Define ===== -->
            <g>
                <circle cx="436.2" cy="613.8" r="118" class="outer" />
                <path class="outerShade" d="M 554 602 A 118 118 0 0 1 522 517" />
                <circle cx="436.2" cy="613.8" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />
                <polygon class="arrowBlue" points="523,675 505,665 511,686" />

                <!-- icon: magnifier -->
                <g transform="translate(436.2 613.8)" class="icon">
                    <circle cx="-10" cy="-10" r="44" />
                    <path d="M 18 22 L 62 66" />
                </g>
            </g>

            <!-- ===== Node 3: Ideate ===== -->
            <g>
                <circle cx="709.8" cy="613.8" r="118" class="outer" />
                <path class="outerShade" d="M 827 602 A 118 118 0 0 1 795 517" />
                <circle cx="709.8" cy="613.8" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />
                <polygon class="arrowBlue" points="797,675 779,665 785,686" />

                <!-- icon: bulb -->
                <g transform="translate(709.8 613.8)" class="icon">
                    <path d="M 0 -62
                     C -38 -62 -64 -34 -64 -2
                     C -64 26 -44 40 -28 54
                     C -12 68 -10 82 -10 96
                     H 10
                     C 10 82 12 68 28 54
                     C 44 40 64 26 64 -2
                     C 64 -34 38 -62 0 -62 Z" />
                    <path d="M -22 104 H 22" />
                    <path d="M -18 128 H 18" />
                    <circle cx="0" cy="18" r="6" />
                </g>
            </g>

            <!-- ===== Node 4: Prototype ===== -->
            <g>
                <circle cx="989.4" cy="613.8" r="118" class="outer" />
                <path class="outerShade" d="M 1107 602 A 118 118 0 0 1 1075 517" />
                <circle cx="989.4" cy="613.8" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />
                <polygon class="arrowBlue" points="1076,675 1058,665 1064,686" />

                <!-- icon: tool / prototype (L ruler + pen) -->
                <g transform="translate(989.4 613.8)" class="icon">
                    <!-- L ruler -->
                    <path d="M -52 48 V -30 C -52 -40 -44 -48 -34 -48 H -8" />
                    <path d="M -52 10 H -18" />
                    <!-- pen -->
                    <path d="M 26 -54 V 54" />
                    <path d="M 10 -54 H 42" />
                    <path d="M 10 54 H 42" />
                    <path d="M 26 54 L 14 78 H 38 Z" />
                </g>
            </g>

            <!-- ===== Node 5: Test ===== -->
            <g>
                <circle cx="1267.8" cy="613.8" r="118" class="outer" />
                <path class="outerShade" d="M 1385 602 A 118 118 0 0 1 1353 517" />
                <circle cx="1267.8" cy="613.8" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />
                <polygon class="arrowBlue" points="1355,675 1337,665 1343,686" />

                <!-- icon: checklist -->
                <g transform="translate(1267.8 613.8)" class="icon">
                    <rect x="-62" y="-62" width="124" height="124" rx="14" />
                    <path d="M -34 -8 L -20 6 L -6 -14" />
                    <path d="M -34 24 L -6 52" />
                    <path d="M -6 24 L -34 52" />
                    <path d="M 10 -12 H 44" />
                    <path d="M 10 18 H 44" />
                </g>
            </g>

            <!-- ===== Node 6: Implement ===== -->
            <g>
                <circle cx="1576.2" cy="624.6" r="118" class="outer" />
                <path class="outerShade" d="M 1694 613 A 118 118 0 0 1 1662 528" />
                <circle cx="1576.2" cy="624.6" r="94" class="inner" stroke-dasharray="480 110"
                    stroke-dashoffset="-40" />

                <!-- icon: rocket -->
                <g transform="translate(1576.2 624.6)" class="icon">
                    <path
                        d="M 0 -70 C 26 -52 46 -18 46 14 C 46 38 26 64 0 78 C -26 64 -46 38 -46 14 C -46 -18 -26 -52 0 -70 Z" />
                    <circle cx="0" cy="-6" r="10" />
                    <path d="M -46 14 L -70 28 L -70 2 L -46 -10" />
                    <path d="M 46 14 L 70 28 L 70 2 L 46 -10" />
                    <path d="M 0 78 L -12 106 H 12 Z" />
                </g>
            </g>
        </svg>
    </div>

    <p class="mt-3 text-center text-xs text-white/40 sm:hidden">
        Geser ke samping untuk melihat diagram lengkap.
    </p>
</section>
