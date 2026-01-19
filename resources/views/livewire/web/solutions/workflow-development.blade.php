<!-- Responsive: di desktop bisa membesar, tetap tajam karena SVG -->
<div class="w-full max-w-[900px]">
    <!-- Aspect ratio mirip gambar -->
    <div class="w-full">
        <svg class="loop-svg w-full h-auto" viewBox="0 0 424 157" xmlns="http://www.w3.org/2000/svg"
            aria-label="Development loop diagram" role="img">
            <defs>
                <!-- soft halo/glow di belakang node (mirip gambar) -->
                <filter id="glow" x="-60%" y="-60%" width="220%" height="220%">
                    <feDropShadow dx="0" dy="0" stdDeviation="4" flood-color="#E9EDFF"
                        flood-opacity="1" />
                </filter>

                <style>
                    .blue {
                        fill: #0b2ce8;
                    }

                    .gray {
                        fill: #8a8a94;
                    }

                    .track {
                        stroke: #0b2ce8;
                        stroke-width: 4;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        fill: none;
                    }
                </style>
            </defs>

            <!-- ============ -->
            <!-- HALO (behind) -->
            <!-- ============ -->
            <!-- node centers diambil dari gambar (424x157) -->
            <g opacity="1">
                <!-- top -->
                <circle cx="40.5" cy="38.9" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="124.3" cy="38.7" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="210.5" cy="38.6" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="298.5" cy="39.6" r="18" fill="#E9EDFF" filter="url(#glow)" />

                <!-- bottom -->
                <circle cx="38.2" cy="119.4" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="127.1" cy="120.9" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="213.6" cy="119.9" r="18" fill="#E9EDFF" filter="url(#glow)" />
                <circle cx="344.3" cy="119.6" r="18" fill="#E9EDFF" filter="url(#glow)" />
            </g>

            <!-- ===== -->
            <!-- TRACK -->
            <!-- ===== -->
            <!-- rounded loop seperti gambar -->
            <path class="track" d="M40 39
            H371
            A40.5268 40.5268 0 0 1 371 120
            H40
            A42.3375 42.3375 0 0 1 40 39" />

            <!-- ========== -->
            <!-- ARROWH EADS -->
            <!-- ========== -->
            <!-- Arrowhead polygon points diambil dari bounding box arrow di gambar -->
            <!-- Top (→) -->
            <polygon class="blue" points="110,39.5 95,32 95,47" />
            <polygon class="blue" points="196,39 181,32 181,46" />
            <polygon class="blue" points="284,39 270,32 270,46" />
            <polygon class="blue" points="371,40.5 356,34 356,47" />

            <!-- Bottom (←) -->
            <polygon class="blue" points="226,119.5 245,110 245,129" />
            <polygon class="blue" points="140,120 159,113 159,127" />
            <polygon class="blue" points="51,119.5 70,110 70,129" />

            <!-- ===== -->
            <!-- NODES -->
            <!-- ===== -->
            <!-- r=15 biar ukuran node mirip gambar -->
            <!-- top -->
            <circle class="blue" cx="40.5" cy="38.9" r="15" />
            <circle class="blue" cx="124.3" cy="38.7" r="15" />
            <circle class="blue" cx="210.5" cy="38.6" r="15" />
            <circle class="blue" cx="298.5" cy="39.6" r="15" />

            <!-- bottom -->
            <circle class="blue" cx="38.2" cy="119.4" r="15" />
            <circle class="blue" cx="127.1" cy="120.9" r="15" />
            <circle class="blue" cx="213.6" cy="119.9" r="15" />
            <circle class="blue" cx="344.3" cy="119.6" r="15" />

            <!-- ======== -->
            <!-- NUMBERS -->
            <!-- ======== -->
            <g font-size="14" font-weight="800" fill="#fff" text-anchor="middle">
                <text x="40.5" y="44.2">1</text>
                <text x="124.3" y="44.0">2</text>
                <text x="210.5" y="43.9">3</text>
                <text x="298.5" y="44.9">4</text>

                <text x="38.2" y="124.7">8</text>
                <text x="127.1" y="126.2">7</text>
                <text x="213.6" y="125.2">6</text>
                <text x="344.3" y="124.9">5</text>
            </g>

            <!-- ====== -->
            <!-- LABELS -->
            <!-- ====== -->
            <!-- posisi X disesuaikan dari centroid teks di gambar -->
            <g class="gray" font-size="18" font-weight="700" text-anchor="middle">
                <!-- top -->
                <text x="39.4" y="16">Scope</text>
                <text x="213.1" y="16">Propose</text>

                <!-- middle -->
                <text x="120.4" y="78">Estimate</text>
                <text x="324.8" y="78">Develop</text>

                <!-- bottom -->
                <text x="49.8" y="154">Measure</text>
                <text x="127.1" y="154">UAT</text>
                <text x="201.8" y="154">Deploy</text>
                <text x="358.1" y="154">Demo</text>
            </g>
        </svg>
    </div>

    <!-- hint mobile (optional) -->
    <p class="mt-3 text-center text-xs text-slate-500 sm:hidden">
        Diagram otomatis menyesuaikan layar.
    </p>
</div>
