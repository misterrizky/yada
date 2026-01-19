<div class="relative isolate">
    <div class="mx-auto max-w-7xl">
        <svg viewBox="0 0 1081 540" class="w-full h-auto" aria-label="Team relationship model diagram">
            <defs>
                <!-- Arrow heads (Resized to 6x6 for consistency) -->
                <marker id="arrowBlue" markerWidth="6" markerHeight="6" refX="5" refY="3" orient="auto">
                    <path d="M0,0 L6,3 L0,6 Z" fill="#1D4ED8" />
                </marker>

                <marker id="arrowTeal" markerWidth="6" markerHeight="6" refX="5" refY="3" orient="auto">
                    <path d="M0,0 L6,3 L0,6 Z" fill="#22B8D8" />
                </marker>
            </defs>

            <!-- ===================================================== -->
            <!-- CONNECTORS (draw first so nodes sit on top)            -->
            <!-- ===================================================== -->

            <!-- (A) Client <-> Project Coordinator (2 arrows facing) -->
            <!-- Client edge x=71+70=141 | Coord edge x=351-70=281 -->
            <path d="M147 261 H215" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowBlue)" />
            <path d="M281 261 H225" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowBlue)" />

            <!-- (B) Project Coordinator -> Designer (blue to teal, with chevron handoff) -->
            <!-- Coord edge x=351+70=421  | Designer edge x=693-35=658 -->
            <path d="M421 261 H520" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none" />
            <!-- Handoff marker (blue ▶◀ teal) -->
            <!-- Resized to 6x6 with gap. Center ~536. Gap 6px (533-539). -->
            <polygon points="527,258 527,264 533,261" fill="#1D4ED8" />
            <polygon points="545,258 545,264 539,261" fill="#22B8D8" />
            <path d="M552 261 H658" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none" />

            <!-- (C) Designer -> Dev group (teal with chevron marker) -->
            <!-- Designer edge x=693+35=728 | Dev edge x=929-35=894 -->
            <path d="M728 261 H894" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none" />
            <!-- Chevron marker near x~807. Gap 6px (804-810). -->
            <polygon points="798,258 798,264 804,261" fill="#22B8D8" />
            <polygon points="816,258 816,264 810,261" fill="#22B8D8" />

            <!-- (D) Dev down to bottom (teal) -->
            <!-- Dev center (929,261), r=35 => bottom edge y=296 -->
            <path d="M929 296 V465" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none" />

            <!-- (E) Bottom line: QA -> Lead Dev -> right corner (teal) -->
            <path d="M351 465 H929" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none" />
            <!-- bottom chevron markers -->
            <!-- QA -> Lead. Center ~462. Gap 6px (459-465). -->
            <polygon points="453,462 453,468 459,465" fill="#22B8D8" />
            <polygon points="471,462 471,468 465,465" fill="#22B8D8" />

            <!-- Lead -> Dev. Center ~832. Gap 6px (829-835). -->
            <polygon points="823,462 823,468 829,465" fill="#22B8D8" />
            <polygon points="841,462 841,468 835,465" fill="#22B8D8" />

            <!-- (F) Vertical Client <-> Account Manager (blue down, teal up) -->
            <!-- Client bottom edge y=261+70=331 | Account top edge y=457-35=422 -->
            <path d="M81 350 V360" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none"
                  transform="translate(7, 0)"
                marker-end="url(#arrowBlue)" />
            <path d="M81 422 V375" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none"
                  transform="translate(7, 0)"
                marker-end="url(#arrowTeal)" />

            <!-- (G) Vertical Coordinator <-> Auditor (teal down, blue up) -->
            <!-- Auditor bottom edge y=70+35=105 | Coord top edge y=261-70=191 -->
            <path d="M351 105 V145" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowTeal)" />
            <path d="M351 191 V155" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowBlue)" />

            <!-- (H) Vertical Coordinator <-> QA (blue down, teal up) -->
            <!-- Coord bottom edge y=261+70=331 | QA top edge y=465-35=430 -->
            <path d="M351 331 V360" stroke="#1D4ED8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowBlue)" />
            <path d="M351 430 V375" stroke="#22B8D8" stroke-width="3" stroke-linecap="round" fill="none"
                marker-end="url(#arrowTeal)" />

            <!-- ===================================================== -->
            <!-- NODES (big first halos, then circles + icons + labels) -->
            <!-- ===================================================== -->

            <!-- BIG HALOS (soft background circles like image) -->
            <circle cx="88" cy="261" r="86" fill="#E9EDFF" />
            <circle cx="351" cy="261" r="86" fill="#E9EDFF" />

            <!-- CLIENT (big) -->
            <circle cx="88" cy="261" r="70" fill="#0B2CE8" />
            <!-- client icon (white) -->
            <g transform="translate(88 261)" fill="none" stroke="#FFFFFF" stroke-width="6"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-18" r="12" />
                <path d="M-26 20c6-18 16-26 26-26s20 8 26 26" />
                <!-- tie -->
                <path d="M0 -2 L-10 10 L0 30 L10 10 Z" fill="#FFFFFF" stroke="none" />
            </g>

            <!-- label "Client" (blue, top-left of big circle) -->
            <text x="16" y="170" fill="#1D4ED8" font-size="16" font-weight="700">
                Client
            </text>

            <!-- PROJECT COORDINATOR (big) -->
            <circle cx="351" cy="261" r="70" fill="#0B2CE8" />
            <!-- clipboard icon -->
            <g transform="translate(351 261)" fill="none" stroke="#FFFFFF" stroke-width="6"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="-22" y="-16" width="44" height="52" rx="4" />
                <path d="M-12 -16v-8h24v8" />
                <path d="M-12 2h24M-12 16h24M-12 30h24" />
            </g>

            <!-- label "Project Coordinator" (blue, to the right of big node) -->
            <text x="422" y="210" fill="#1D4ED8" font-size="16" font-weight="700">
                Project
            </text>
            <text x="432" y="232" fill="#1D4ED8" font-size="16" font-weight="700">
                Coordinator
            </text>

            <!-- AUDITOR (small teal) -->
            <circle cx="351" cy="70" r="35" fill="#22B8D8" />
            <g transform="translate(351 70)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" />
            </g>
            <text x="351" y="22" text-anchor="middle" fill="#22B8D8" font-size="14" font-weight="700">
                Auditor
            </text>

            <!-- DESIGNER (small teal) -->
            <circle cx="693" cy="261" r="35" fill="#22B8D8" />
            <g transform="translate(693 261)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" />
            </g>
            <text x="693" y="190" text-anchor="middle" fill="#22B8D8" font-size="14" font-weight="700">
                Designer
            </text>

            <!-- DEV GROUP (small teal) -->
            <circle cx="929" cy="261" r="35" fill="#22B8D8" />
            <g transform="translate(929 261)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" />
            </g>
            <text x="985" y="250" fill="#22B8D8" font-size="14" font-weight="700">
                Backend Dev
            </text>
            <text x="985" y="270" fill="#22B8D8" font-size="14" font-weight="700">
                Frontend Dev
            </text>
            <text x="985" y="290" fill="#22B8D8" font-size="14" font-weight="700">
                Mobile Dev
            </text>

            <!-- ACCOUNT MANAGER (small teal) -->
            <circle cx="88" cy="459" r="35" fill="#22B8D8" />
            <g transform="translate(81 457)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="7" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" transform="translate(7, 5)" />
            </g>
            <text x="30" y="535" fill="#22B8D8" font-size="14" font-weight="700">
                Account Manager
            </text>

            <!-- QA OFFICER (small teal) -->
            <circle cx="351" cy="465" r="35" fill="#22B8D8" />
            <g transform="translate(351 465)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" />
            </g>
            <text x="351" y="535" text-anchor="middle" fill="#22B8D8" font-size="14" font-weight="700">
                QA Officer
            </text>

            <!-- LEAD DEVELOPER (small teal) -->
            <circle cx="650" cy="465" r="35" fill="#22B8D8" />
            <g transform="translate(650 465)" fill="none" stroke="#FFFFFF" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="0" cy="-12" r="10" />
                <path d="M-20 20c5-14 13-20 20-20s15 6 20 20" />
            </g>
            <text x="650" y="535" text-anchor="middle" fill="#22B8D8" font-size="14" font-weight="700">
                Lead Developer
            </text>
        </svg>
    </div>
</div>
