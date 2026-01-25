(() => {
    if (typeof window === "undefined") return;
    if (window.location.origin !== "http://yex.co.id" || window.location.origin !== "https://yex.co.id") return;

    // Footer year (optional)
    let yearEl = null;

    // GSAP setup
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
    let prefersReduced = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;
    const themeStorageKey = "saas-theme";

    // ===== Elements =====
    let desktopNav = null;
    let navIndicator = null;

    let megaOverlay = null;
    let megaBackdrop = null;
    let megaPanel = null;
    let btnMegaClose = null;

    let megaInner = null;
    let megaParallaxGlow = null;
    let megaSolutions = null;
    let megaWorks = null;
    let megaExplore = null;

    let cursor = null;
    let cursorDot = null;
    let cursorRing = null;

    let btnSolutions = null;
    let btnWorks = null;
    let btnExplore = null;
    let navContact = null;

    let btnMobile = null;
    let mobileDrawer = null;
    let mobileBackdrop = null;
    let mobilePanel = null;
    let btnMobileClose = null;

    let projectsGrid = null;
    let projectsSearch = null;
    let projectsKbd = null;
    let projectsHint = null;

    // Project modal (home)
    let projectModal = null;
    let projectModalBackdrop = null;
    let projectModalPanel = null;
    let projectModalClose = null;
    let projectModalType = null;
    let projectModalTitle = null;
    let projectModalDesc = null;
    let projectModalTags = null;
    let projectModalCopy = null;

    // Mobile sticky CTA (home)
    let mobileCtaBar = null;

    // Works preview elements
    let worksPreviewCanvas = null;
    let worksPreviewTitle = null;
    let worksPreviewSub = null;

    // Theme toggle
    let themeToggle = null;
    let themeIconSun = null;
    let themeIconMoon = null;
    let themedImages = [];

    // Solutions tabs
    let solTabs = [];
    let solPanels = [];

    // ===== State =====
    let openMega = null; // 'solutions' | 'works' | 'explore' | null
    let lastFocus = null;
    let activeNavKey = "works";

    // Home projects state
    let projectsFilter = "all";
    let projectsQuery = "";
    let projectModalOpen = false;
    let projectModalLastFocus = null;
    let navScrollTriggers = [];
    let logoIntervalId = 0;
    let logoStep = 0;
    let mobileCtaListenersBound = false;
    let livewireHandlersBound = false;
    let themeMediaBound = false;

    function initThemeToggle() {
        const btn = document.querySelector("[data-theme-toggle]");
        if (!btn || btn.dataset.bound) return;
        btn.dataset.bound = "1";

        btn.addEventListener("click", () => {
            /* toggle theme */
        });
    }

    function refreshCoreDom() {
        yearEl = document.getElementById("year");
        if (yearEl) yearEl.textContent = new Date().getFullYear();

        prefersReduced = window.matchMedia(
            "(prefers-reduced-motion: reduce)",
        ).matches;

        desktopNav = document.querySelector("[data-desktop-nav]");
        navIndicator = document.getElementById("navIndicator");

        megaOverlay = document.getElementById("megaOverlay");
        megaBackdrop = document.getElementById("megaBackdrop");
        megaPanel = document.getElementById("megaPanel");
        btnMegaClose = document.getElementById("btnMegaClose");

        megaInner = document.getElementById("megaInner");
        megaParallaxGlow = document.getElementById("megaParallaxGlow");
        megaSolutions = document.getElementById("megaSolutions");
        megaWorks = document.getElementById("megaWorks");
        megaExplore = document.getElementById("megaExplore");

        cursor = document.getElementById("yexCursor");
        cursorDot = document.getElementById("yexCursorDot");
        cursorRing = document.getElementById("yexCursorRing");

        btnSolutions = document.getElementById("btnSolutions");
        btnWorks = document.getElementById("btnWorks");
        btnExplore = document.getElementById("btnExplore");
        navContact = document.getElementById("navContact");

        btnMobile = document.getElementById("btnMobile");
        mobileDrawer = document.getElementById("mobileDrawer");
        mobileBackdrop = document.getElementById("mobileBackdrop");
        mobilePanel = document.getElementById("mobilePanel");
        btnMobileClose = document.getElementById("btnMobileClose");

        projectsGrid = document.getElementById("projectsGrid");
        projectsSearch = document.getElementById("projectsSearch");
        projectsKbd = document.getElementById("projectsKbd");
        projectsHint = document.getElementById("projectsHint");

        projectModal = document.getElementById("projectModal");
        projectModalBackdrop = document.getElementById("projectModalBackdrop");
        projectModalPanel = document.getElementById("projectModalPanel");
        projectModalClose = document.getElementById("projectModalClose");
        projectModalType = document.getElementById("projectModalType");
        projectModalTitle = document.getElementById("projectModalTitle");
        projectModalDesc = document.getElementById("projectModalDesc");
        projectModalTags = document.getElementById("projectModalTags");
        projectModalCopy = document.getElementById("projectModalCopy");

        mobileCtaBar = document.getElementById("mobileCtaBar");

        worksPreviewCanvas = document.getElementById("worksPreviewCanvas");
        worksPreviewTitle = document.getElementById("worksPreviewTitle");
        worksPreviewSub = document.getElementById("worksPreviewSub");

        themedImages = Array.from(
            document.querySelectorAll("[data-theme-image]"),
        );

        solTabs = Array.from(document.querySelectorAll(".yex-sol-tab"));
        solPanels = Array.from(document.querySelectorAll(".yex-sol-panel"));
    }

    // ===== Utils =====
    function getFocusable(container) {
        if (!container) return [];
        const sel = [
            "a[href]",
            "button:not([disabled])",
            "input:not([disabled])",
            "select:not([disabled])",
            "textarea:not([disabled])",
            '[tabindex]:not([tabindex="-1"])',
        ].join(",");
        return Array.from(container.querySelectorAll(sel)).filter(
            (el) => !el.hasAttribute("disabled"),
        );
    }

    function bindOnce(el, key, type, handler, options) {
        if (!el) return;
        const prev = el.dataset.yexBound || "";
        const tokens = new Set(prev.split(" ").filter(Boolean));
        if (tokens.has(key)) return;
        tokens.add(key);
        el.dataset.yexBound = Array.from(tokens).join(" ");
        el.addEventListener(type, handler, options);
    }

    // ===== Helpers =====
    function setMegaVisible(visible) {
        megaOverlay.classList.toggle("pointer-events-none", !visible);
        megaOverlay.classList.toggle("invisible", !visible);
        megaOverlay.setAttribute("aria-hidden", visible ? "false" : "true");
    }

    function setMobileVisible(visible) {
        mobileDrawer.classList.toggle("pointer-events-none", !visible);
        mobileDrawer.classList.toggle("invisible", !visible);
        mobileDrawer.setAttribute("aria-hidden", visible ? "false" : "true");
    }

    function isMegaVisible() {
        return megaOverlay && !megaOverlay.classList.contains("invisible");
    }

    function getMegaEl(which) {
        if (which === "solutions") return megaSolutions;
        if (which === "works") return megaWorks;
        if (which === "explore") return megaExplore;
        return null;
    }

    function showOnlyMega(which) {
        megaSolutions.classList.toggle("hidden", which !== "solutions");
        megaWorks.classList.toggle("hidden", which !== "works");
        megaExplore.classList.toggle("hidden", which !== "explore");

        btnSolutions.setAttribute(
            "aria-expanded",
            which === "solutions" ? "true" : "false",
        );
        btnWorks.setAttribute(
            "aria-expanded",
            which === "works" ? "true" : "false",
        );
        btnExplore.setAttribute(
            "aria-expanded",
            which === "explore" ? "true" : "false",
        );
    }

    function animateMegaEnter(which) {
        const el = getMegaEl(which);
        if (!el) return;

        const targets = el.querySelectorAll(".yex-mega-anim");
        if (prefersReduced) return;

        gsap.fromTo(
            targets,
            {
                opacity: 0,
                y: 10,
                filter: "blur(6px)",
            },
            {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                duration: 0.35,
                ease: "power3.out",
                stagger: 0.06,
                clearProps: "filter",
            },
        );
    }

    function animateMegaSwitch(fromKey, toKey) {
        const fromEl = getMegaEl(fromKey);
        const toEl = getMegaEl(toKey);
        if (!fromEl || !toEl) {
            showOnlyMega(toKey);
            animateMegaEnter(toKey);
            return;
        }

        const outTargets = fromEl.querySelectorAll(".yex-mega-anim");
        const inTargets = toEl.querySelectorAll(".yex-mega-anim");

        if (prefersReduced) {
            showOnlyMega(toKey);
            return;
        }

        gsap.timeline()
            .to(outTargets, {
                opacity: 0,
                y: -8,
                filter: "blur(6px)",
                duration: 0.22,
                ease: "power2.in",
                stagger: 0.04,
            })
            .add(() => {
                showOnlyMega(toKey);
                window.dispatchEvent(new Event("resize")); // refresh WebGL sizes
            })
            .fromTo(
                inTargets,
                {
                    opacity: 0,
                    y: 10,
                    filter: "blur(8px)",
                },
                {
                    opacity: 1,
                    y: 0,
                    filter: "blur(0px)",
                    duration: 0.33,
                    ease: "power3.out",
                    stagger: 0.06,
                    clearProps: "filter",
                },
            );
    }

    function focusFirstInMega(which) {
        let target = null;
        if (which === "solutions") target = document.getElementById("tab-ai");
        if (which === "works")
            target = megaWorks?.querySelector(".yex-work-filter");
        if (which === "explore") target = megaExplore?.querySelector("a[href]");

        if (!target) {
            const focusables = getFocusable(megaPanel);
            target = focusables[0] || btnMegaClose;
        }
        target?.focus({
            preventScroll: true,
        });
    }

    function showMega(which) {
        if (!megaOverlay || !megaPanel) return;

        // if already visible, do a switch animation
        if (isMegaVisible() && openMega && openMega !== which) {
            const from = openMega;
            openMega = which;
            animateMegaSwitch(from, which);
            focusFirstInMega(which);
            enableMegaParallax();
            maybeStartWorksPreview();
            return;
        }

        // open fresh
        lastFocus = document.activeElement;
        openMega = which;

        showOnlyMega(which);
        setMegaVisible(true);
        enableMegaParallax();

        if (prefersReduced) {
            gsap.set(megaOverlay, {
                opacity: 1,
            });
            gsap.set(megaPanel, {
                opacity: 1,
                scale: 1,
                y: 0,
            });
            animateMegaEnter(which);
            focusFirstInMega(which);
            maybeStartWorksPreview();
        } else {
            gsap.killTweensOf([megaOverlay, megaPanel]);
            gsap.set(megaPanel, {
                opacity: 0,
                scale: 0.985,
                y: -10,
                rotateX: 2,
                transformPerspective: 900,
            });
            gsap.to(megaOverlay, {
                opacity: 1,
                duration: 0.18,
                ease: "power2.out",
            });

            gsap.to(megaPanel, {
                opacity: 1,
                scale: 1,
                y: 0,
                rotateX: 0,
                duration: 0.34,
                ease: "power3.out",
                onComplete: () => {
                    animateMegaEnter(which);
                    focusFirstInMega(which);
                    maybeStartWorksPreview();
                },
            });
        }

        window.dispatchEvent(new Event("resize"));
    }

    function hideMega() {
        if (!openMega) return;
        const restoreTo = lastFocus;
        openMega = null;

        btnSolutions.setAttribute("aria-expanded", "false");
        btnWorks.setAttribute("aria-expanded", "false");
        btnExplore.setAttribute("aria-expanded", "false");

        stopWorksPreview();
        disableMegaParallax();

        if (prefersReduced) {
            gsap.set(megaOverlay, {
                opacity: 0,
            });
            gsap.set(megaPanel, {
                opacity: 0,
            });
            setMegaVisible(false);
            showOnlyMega("none");
            restoreTo?.focus?.({
                preventScroll: true,
            });
            return;
        }

        gsap.killTweensOf([megaOverlay, megaPanel]);
        gsap.to(megaPanel, {
            opacity: 0,
            scale: 0.985,
            y: -10,
            duration: 0.18,
            ease: "power2.in",
        });
        gsap.to(megaOverlay, {
            opacity: 0,
            duration: 0.18,
            ease: "power2.in",
            onComplete: () => {
                setMegaVisible(false);
                showOnlyMega("none");
                restoreTo?.focus?.({
                    preventScroll: true,
                });
            },
        });
    }

    // ===== Mega parallax (pointer-driven) =====
    let megaParallaxActive = false;
    let megaMoveHandler = null;
    let megaLeaveHandler = null;

    function enableMegaParallax() {
        if (prefersReduced) return;
        if (!megaPanel || !megaInner) return;
        if (megaParallaxActive) return;
        megaParallaxActive = true;

        const qx = gsap.quickTo(megaInner, "x", {
            duration: 0.35,
            ease: "power3.out",
        });
        const qy = gsap.quickTo(megaInner, "y", {
            duration: 0.35,
            ease: "power3.out",
        });
        const qrx = gsap.quickTo(megaInner, "rotateX", {
            duration: 0.35,
            ease: "power3.out",
        });
        const qry = gsap.quickTo(megaInner, "rotateY", {
            duration: 0.35,
            ease: "power3.out",
        });

        const qgx = megaParallaxGlow
            ? gsap.quickTo(megaParallaxGlow, "x", {
                  duration: 0.45,
                  ease: "power3.out",
              })
            : null;
        const qgy = megaParallaxGlow
            ? gsap.quickTo(megaParallaxGlow, "y", {
                  duration: 0.45,
                  ease: "power3.out",
              })
            : null;

        megaMoveHandler = (e) => {
            const r = megaPanel.getBoundingClientRect();
            const px = (e.clientX - r.left) / r.width - 0.5;
            const py = (e.clientY - r.top) / r.height - 0.5;

            const tiltX = py * -6.0;
            const tiltY = px * 8.0;

            qx(px * 14);
            qy(py * 10);
            qrx(tiltX);
            qry(tiltY);

            if (qgx && qgy) {
                qgx(px * 40);
                qgy(py * 28);
            }
        };

        megaLeaveHandler = () => {
            gsap.to(megaInner, {
                x: 0,
                y: 0,
                rotateX: 0,
                rotateY: 0,
                duration: 0.6,
                ease: "power3.out",
            });
            if (megaParallaxGlow)
                gsap.to(megaParallaxGlow, {
                    x: 0,
                    y: 0,
                    duration: 0.8,
                    ease: "power3.out",
                });
        };

        megaPanel.addEventListener("pointermove", megaMoveHandler);
        megaPanel.addEventListener("pointerleave", megaLeaveHandler);
    }

    function disableMegaParallax() {
        if (!megaPanel || !megaInner) return;
        if (!megaParallaxActive) return;
        megaParallaxActive = false;

        megaPanel.removeEventListener("pointermove", megaMoveHandler);
        megaPanel.removeEventListener("pointerleave", megaLeaveHandler);

        megaMoveHandler = null;
        megaLeaveHandler = null;

        gsap.set(megaInner, {
            x: 0,
            y: 0,
            rotateX: 0,
            rotateY: 0,
        });
        if (megaParallaxGlow)
            gsap.set(megaParallaxGlow, {
                x: 0,
                y: 0,
            });
    }

    // ===== Focus trap (Mega + Mobile) =====
    function trapFocus(e) {
        const isMegaOpen = !!openMega;
        const isMobileOpen =
            mobileDrawer && !mobileDrawer.classList.contains("invisible");
        const isProjectOpen =
            projectModalOpen &&
            projectModal &&
            !projectModal.classList.contains("invisible");
        if (!isMegaOpen && !isMobileOpen && !isProjectOpen) return;

        const container = isProjectOpen
            ? projectModalPanel
            : isMegaOpen
              ? megaPanel
              : mobilePanel;
        const focusables = getFocusable(container);
        if (!focusables.length) return;

        const first = focusables[0];
        const last = focusables[focusables.length - 1];

        if (e.key === "Tab") {
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    }

    // ===== ESC close =====
    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            if (openMega) hideMega();
            if (mobileDrawer && !mobileDrawer.classList.contains("invisible"))
                closeMobile();
            if (projectModalOpen) closeProjectModal();
        }
    });

    // Focus trap keydown
    document.addEventListener("keydown", trapFocus);

    // ===== Solutions tabs =====
    function activateSolTab(tabKey, focusTab = false) {
        solTabs.forEach((t) => {
            const isActive = t.dataset.tab === tabKey;
            t.classList.toggle("bg-white/10", isActive);
            t.classList.toggle("bg-white/5", !isActive);
            t.setAttribute("aria-selected", isActive ? "true" : "false");
            t.tabIndex = isActive ? 0 : -1;
            if (isActive && focusTab)
                t.focus({
                    preventScroll: true,
                });
        });

        solPanels.forEach((p) => {
            const isTarget = p.dataset.panel === tabKey;
            if (isTarget) {
                p.classList.remove("hidden");
                if (!prefersReduced) {
                    // micro “section enter”
                    gsap.fromTo(
                        p,
                        {
                            opacity: 0,
                            y: 8,
                            filter: "blur(6px)",
                        },
                        {
                            opacity: 1,
                            y: 0,
                            duration: 0.22,
                            ease: "power2.out",
                            clearProps: "filter",
                        },
                    );
                }
            } else {
                p.classList.add("hidden");
            }
        });
    }

    function handleSolTabKeydown(e) {
        if (e.key !== "ArrowDown" && e.key !== "ArrowUp") return;
        e.preventDefault();
        const tabs = solTabs;
        const idx = tabs.indexOf(e.currentTarget);
        if (idx < 0) return;
        const dir = e.key === "ArrowDown" ? 1 : -1;
        const next = (idx + dir + tabs.length) % tabs.length;
        activateSolTab(tabs[next].dataset.tab, true);
    }

    function bindSolTabs() {
        solTabs.forEach((btn) => {
            bindOnce(btn, "sol-click", "click", () =>
                activateSolTab(btn.dataset.tab),
            );
            bindOnce(btn, "sol-keydown", "keydown", handleSolTabKeydown);
        });
    }

    // ===== Mobile drawer =====
    function openMobile() {
        btnMobile?.setAttribute("aria-expanded", "true");
        setMobileVisible(true);

        if (prefersReduced) {
            gsap.set(mobileDrawer, {
                opacity: 1,
            });
            gsap.set(mobilePanel, {
                x: "0%",
            });
            getFocusable(mobilePanel)[0]?.focus?.({
                preventScroll: true,
            });
            return;
        }

        gsap.killTweensOf([mobileDrawer, mobilePanel]);
        gsap.set(mobilePanel, {
            x: "100%",
        });
        gsap.to(mobileDrawer, {
            opacity: 1,
            duration: 0.18,
            ease: "power2.out",
        });
        gsap.to(mobilePanel, {
            x: "0%",
            duration: 0.26,
            ease: "power3.out",
            onComplete: () =>
                getFocusable(mobilePanel)[0]?.focus?.({
                    preventScroll: true,
                }),
        });
    }

    function closeMobile() {
        btnMobile?.setAttribute("aria-expanded", "false");

        if (prefersReduced) {
            gsap.set(mobileDrawer, {
                opacity: 0,
            });
            gsap.set(mobilePanel, {
                x: "100%",
            });
            setMobileVisible(false);
            btnMobile?.focus?.({
                preventScroll: true,
            });
            return;
        }

        gsap.killTweensOf([mobileDrawer, mobilePanel]);
        gsap.to(mobilePanel, {
            x: "100%",
            duration: 0.18,
            ease: "power2.in",
        });
        gsap.to(mobileDrawer, {
            opacity: 0,
            duration: 0.18,
            ease: "power2.in",
            onComplete: () => {
                setMobileVisible(false);
                btnMobile?.focus?.({
                    preventScroll: true,
                });
            },
        });
    }

    // ===== Smooth scroll (GSAP ScrollTo) =====
    function smoothScrollTo(selector) {
        const target = document.querySelector(selector);
        if (!target) return;
        const headerOffset = 80;
        const y =
            target.getBoundingClientRect().top +
            window.pageYOffset -
            headerOffset;
        if (prefersReduced)
            window.scrollTo({
                top: y,
                behavior: "auto",
            });
        else
            gsap.to(window, {
                duration: 0.9,
                ease: "power3.out",
                scrollTo: y,
            });
    }
    document.addEventListener("click", (e) => {
        const a = e.target.closest("a[href]");
        if (!a) return;

        const href = a.getAttribute("href") || "";
        if (href.startsWith("#")) {
            const target = document.querySelector(href);
            hideMega();
            closeMobile();
            if (!target) return;
            e.preventDefault();
            smoothScrollTo(href);
        } else {
            hideMega();
            closeMobile();
        }
    });

    // ===== Home Projects: filter + search =====
    function updateProjectsKbdHint() {
        if (!projectsKbd) return;

        const isDesktop = window.matchMedia("(min-width: 768px)").matches;
        const isMac =
            /Mac|iPhone|iPad|iPod/i.test(navigator.platform) ||
            /Mac/i.test(navigator.userAgent);
        projectsKbd.textContent = isMac ? "⌘K" : "Ctrl K";
        projectsKbd.style.display = isDesktop ? "block" : "none";
    }
    window.addEventListener("resize", updateProjectsKbdHint);

    function normalize(s) {
        return (s || "").toLowerCase().replace(/\s+/g, " ").trim();
    }

    function renderProjects() {
        if (!projectsGrid) return;
        const cards = Array.from(projectsGrid.querySelectorAll("[data-work]"));
        if (!cards.length) return;

        const q = normalize(projectsQuery);
        const tokens = q ? q.split(" ").filter(Boolean) : [];

        cards.forEach((card) => {
            const tags = (card.dataset.work || "").split(/\s+/).filter(Boolean);
            const matchFilter =
                projectsFilter === "all" || tags.includes(projectsFilter);

            const haystack = normalize(
                [
                    card.dataset.title,
                    card.dataset.type,
                    card.dataset.desc,
                    card.dataset.tags,
                    card.textContent,
                ].join(" "),
            );
            const matchQuery =
                !tokens.length || tokens.every((t) => haystack.includes(t));

            const show = matchFilter && matchQuery;
            const isHidden = card.classList.contains("hidden");
            if (show && !isHidden) return;
            if (!show && isHidden) return;

            if (prefersReduced) {
                card.classList.toggle("hidden", !show);
                card.setAttribute("aria-hidden", show ? "false" : "true");
                return;
            }

            if (show) {
                card.classList.remove("hidden");
                card.setAttribute("aria-hidden", "false");
                gsap.fromTo(
                    card,
                    {
                        opacity: 0,
                        y: 10,
                    },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.22,
                        ease: "power2.out",
                        clearProps: "opacity,transform",
                    },
                );
            } else {
                gsap.to(card, {
                    opacity: 0,
                    y: 10,
                    duration: 0.16,
                    ease: "power2.in",
                    onComplete: () => {
                        card.classList.add("hidden");
                        card.setAttribute("aria-hidden", "true");
                        gsap.set(card, {
                            opacity: 1,
                            y: 0,
                        });
                    },
                });
            }
        });
    }

    // ===== Works filter → Projects section (shared with mega menu) =====
    function applyWorksFilter(filter) {
        projectsFilter = filter || "all";

        document.querySelectorAll(".yex-work-filter").forEach((btn) => {
            const on = btn.dataset.filter === projectsFilter;
            btn.classList.toggle("bg-white/10", on);
            btn.classList.toggle("bg-white/5", !on);
            btn.classList.toggle("text-white", on);
            btn.classList.toggle("text-white/85", !on);
            btn.setAttribute("aria-pressed", on ? "true" : "false");
        });

        renderProjects();
    }

    function handleProjectsInput(e) {
        projectsQuery = e.target.value || "";
        renderProjects();
    }

    // Cmd/Ctrl+K focuses the search input
    window.addEventListener("keydown", (e) => {
        const key = (e.key || "").toLowerCase();
        if ((e.metaKey || e.ctrlKey) && key === "k" && projectsSearch) {
            e.preventDefault();
            projectsSearch.focus();
            projectsSearch.select?.();
        }
    });

    // ===== Project quick view modal (home) =====
    function openProjectModal(card) {
        if (!projectModal || !projectModalPanel) return;
        projectModalLastFocus = document.activeElement;
        projectModalOpen = true;

        // Populate
        const title =
            card?.dataset?.title ||
            card.querySelector("h3")?.textContent ||
            "Project";
        const type = card?.dataset?.type || "Project";
        const desc = card?.dataset?.desc || "";
        const tags = (card?.dataset?.tags || "")
            .split(",")
            .map((t) => t.trim())
            .filter(Boolean);

        if (projectModalTitle) projectModalTitle.textContent = title;
        if (projectModalType) projectModalType.textContent = type;
        if (projectModalDesc) projectModalDesc.textContent = desc;
        if (projectModalTags) {
            projectModalTags.innerHTML = "";
            tags.forEach((t) => {
                const pill = document.createElement("span");
                pill.className =
                    "rounded-full bg-white/5 px-3 py-1 text-xs text-white/70 ring-1 ring-white/10";
                pill.textContent = t;
                projectModalTags.appendChild(pill);
            });
        }

        projectModal.classList.remove("invisible", "pointer-events-none");
        projectModal.setAttribute("aria-hidden", "false");

        // Hide mobile bar while modal open
        setMobileCtaVisible(false);

        if (prefersReduced) {
            gsap.set(projectModalBackdrop, {
                opacity: 1,
            });
            gsap.set(projectModalPanel, {
                opacity: 1,
                y: 0,
            });
            projectModalClose?.focus?.({
                preventScroll: true,
            });
            return;
        }

        gsap.killTweensOf([projectModalBackdrop, projectModalPanel]);
        gsap.set(projectModalBackdrop, {
            opacity: 0,
        });
        gsap.set(projectModalPanel, {
            opacity: 0,
            y: 24,
        });
        gsap.timeline()
            .to(
                projectModalBackdrop,
                {
                    opacity: 1,
                    duration: 0.18,
                    ease: "power2.out",
                },
                0,
            )
            .to(
                projectModalPanel,
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.26,
                    ease: "power3.out",
                    onComplete: () =>
                        projectModalClose?.focus?.({
                            preventScroll: true,
                        }),
                },
                0.02,
            );
    }

    function closeProjectModal() {
        if (!projectModal || !projectModalPanel) return;
        if (!projectModalOpen) return;
        projectModalOpen = false;

        const restoreTo = projectModalLastFocus;

        if (prefersReduced) {
            gsap.set(projectModalBackdrop, {
                opacity: 0,
            });
            gsap.set(projectModalPanel, {
                opacity: 0,
                y: 24,
            });
            projectModal.classList.add("invisible", "pointer-events-none");
            projectModal.setAttribute("aria-hidden", "true");
            restoreTo?.focus?.({
                preventScroll: true,
            });
            updateMobileCta();
            return;
        }

        gsap.killTweensOf([projectModalBackdrop, projectModalPanel]);
        gsap.timeline({
            onComplete: () => {
                projectModal.classList.add("invisible", "pointer-events-none");
                projectModal.setAttribute("aria-hidden", "true");
                restoreTo?.focus?.({
                    preventScroll: true,
                });
                updateMobileCta();
            },
        })
            .to(
                projectModalPanel,
                {
                    opacity: 0,
                    y: 24,
                    duration: 0.18,
                    ease: "power2.in",
                },
                0,
            )
            .to(
                projectModalBackdrop,
                {
                    opacity: 0,
                    duration: 0.18,
                    ease: "power2.in",
                },
                0.02,
            );
    }

    function handleProjectsGridClick(e) {
        const card = e.target.closest(".yex-project-card");
        if (!card) return;
        openProjectModal(card);
    }

    async function handleProjectModalCopy() {
        const text = projectModalTitle?.textContent?.trim() || "";
        if (!text) return;
        try {
            await navigator.clipboard.writeText(text);
            const prev = projectModalCopy.textContent;
            projectModalCopy.textContent = "Copied!";
            setTimeout(() => (projectModalCopy.textContent = prev), 1200);
        } catch {
            // Fallback
            const ta = document.createElement("textarea");
            ta.value = text;
            ta.style.position = "fixed";
            ta.style.left = "-9999px";
            document.body.appendChild(ta);
            ta.select();
            document.execCommand("copy");
            document.body.removeChild(ta);
            const prev = projectModalCopy.textContent;
            projectModalCopy.textContent = "Copied!";
            setTimeout(() => (projectModalCopy.textContent = prev), 1200);
        }
    }

    // ===== Mobile sticky CTA (home) =====
    let mobileCtaShown = false;

    function setMobileCtaVisible(show) {
        if (!mobileCtaBar) return;
        mobileCtaShown = !!show;
        mobileCtaBar.classList.toggle("pointer-events-none", !show);

        if (prefersReduced) {
            mobileCtaBar.style.opacity = show ? "1" : "0";
            mobileCtaBar.style.transform = show
                ? "translateY(0px)"
                : "translateY(12px)";
            return;
        }

        gsap.to(mobileCtaBar, {
            opacity: show ? 1 : 0,
            y: show ? 0 : 12,
            duration: 0.22,
            ease: show ? "power3.out" : "power2.in",
        });
    }

    function updateMobileCta() {
        if (!mobileCtaBar) return;
        const isMobile = !window.matchMedia("(min-width: 768px)").matches;
        if (!isMobile) {
            setMobileCtaVisible(false);
            return;
        }
        if (projectModalOpen) {
            setMobileCtaVisible(false);
            return;
        }

        // Hide when CTA section is near viewport (avoid covering primary buttons)
        const cta = document.getElementById("cta");
        if (cta) {
            const top = cta.getBoundingClientRect().top;
            if (top < window.innerHeight * 0.35) {
                setMobileCtaVisible(false);
                return;
            }
        }
        const show = window.scrollY > Math.min(260, window.innerHeight * 0.25);
        if (show === mobileCtaShown) return;
        setMobileCtaVisible(show);
    }

    function bindMobileCtaListeners() {
        if (mobileCtaListenersBound) return;
        mobileCtaListenersBound = true;
        let raf = 0;
        const onScroll = () => {
            if (raf) return;
            raf = requestAnimationFrame(() => {
                raf = 0;
                updateMobileCta();
            });
        };
        window.addEventListener("scroll", onScroll, {
            passive: true,
        });
        window.addEventListener("resize", updateMobileCta);
    }

    // ===== Works Preview Canvas (WebGL thumbnail) =====
    function hexToRgb01(hex) {
        const h = (hex || "#000").replace("#", "").trim();
        const full =
            h.length === 3
                ? h
                      .split("")
                      .map((c) => c + c)
                      .join("")
                : h;
        const n = parseInt(full, 16);
        return [
            ((n >> 16) & 255) / 255,
            ((n >> 8) & 255) / 255,
            (n & 255) / 255,
        ];
    }

    let previewResizeBound = false;

    const preview = {
        running: false,
        raf: 0,
        t0: 0,
        canvas: null,
        // colors (lerped)
        c1: hexToRgb01("#7c3aed"),
        c2: hexToRgb01("#06b6d4"),
        targetC1: hexToRgb01("#7c3aed"),
        targetC2: hexToRgb01("#06b6d4"),
        // mouse (lerped)
        mouse: [0.5, 0.5],
        mouseTarget: [0.5, 0.5],
        // text
        title: "All Works",
        sub: "Highlights across YE portfolio",
        // renderer
        mode: "none", // 'webgl' | '2d'
        gl: null,
        prog: null,
        uTime: null,
        uRes: null,
        uC1: null,
        uC2: null,
        uMouse: null,
        aPos: null,
        buf: null,
        ctx2d: null,
    };

    function createShader(gl, type, src) {
        const sh = gl.createShader(type);
        gl.shaderSource(sh, src);
        gl.compileShader(sh);
        if (!gl.getShaderParameter(sh, gl.COMPILE_STATUS)) {
            console.warn("Preview shader error:", gl.getShaderInfoLog(sh));
            gl.deleteShader(sh);
            return null;
        }
        return sh;
    }

    function initPreviewWebGL(canvas) {
        const gl = canvas.getContext("webgl", {
            antialias: true,
            alpha: true,
            premultipliedAlpha: false,
        });
        if (!gl) return false;

        const vsSrc = `
      attribute vec2 a_pos;
      varying vec2 v_uv;
      void main() {
        v_uv = a_pos * 0.5 + 0.5;
        gl_Position = vec4(a_pos, 0.0, 1.0);
      }
    `;

        const fsSrc = `
      precision mediump float;
      varying vec2 v_uv;

      uniform vec2 u_res;
      uniform float u_time;
      uniform vec3 u_c1;
      uniform vec3 u_c2;
      uniform vec2 u_mouse;

      float hash(vec2 p){
        p = fract(p*vec2(123.34, 456.21));
        p += dot(p, p+34.345);
        return fract(p.x*p.y);
      }

      float noise(vec2 p){
        vec2 i = floor(p);
        vec2 f = fract(p);
        float a = hash(i);
        float b = hash(i+vec2(1.0,0.0));
        float c = hash(i+vec2(0.0,1.0));
        float d = hash(i+vec2(1.0,1.0));
        vec2 u = f*f*(3.0-2.0*f);
        return mix(a,b,u.x) + (c-a)*u.y*(1.0-u.x) + (d-b)*u.x*u.y;
      }

      void main() {
        vec2 uv = v_uv;
        float t = u_time * 0.35;

        // subtle parallax warp towards mouse
        vec2 m = u_mouse;
        vec2 toM = (m - uv);
        float dist = length(toM);
        uv += toM * 0.06 * exp(-4.0 * dist);

        // flowing noise field
        float n1 = noise(uv*5.0 + vec2(t, -t));
        float n2 = noise(uv*10.0 + vec2(-t*0.7, t*0.9));
        float n = (n1*0.65 + n2*0.35);

        // energetic gradient
        float sweep = 0.5 + 0.5*sin(t + uv.y*2.8 + n*0.9);
        vec3 col = mix(u_c1, u_c2, clamp(uv.x + 0.25*sweep, 0.0, 1.0));

        // scanlines + grid
        float scan = 0.06 * sin((uv.y + t*0.25) * 180.0);
        float gridX = smoothstep(0.98, 1.0, abs(fract(uv.x*18.0)-0.5)*2.0);
        float gridY = smoothstep(0.98, 1.0, abs(fract(uv.y*12.0)-0.5)*2.0);
        float grid = (1.0 - gridX) * (1.0 - gridY);

        // glows
        float glow = exp(-6.0*dist) * 0.5;
        col += vec3(glow) + vec3(scan);
        col += 0.18*n + 0.05*grid;

        // vignette
        vec2 p = uv - 0.5;
        float vig = smoothstep(0.95, 0.25, dot(p,p)*1.8);
        col *= vig;

        gl_FragColor = vec4(col, 1.0);
      }
    `;

        const vs = createShader(gl, gl.VERTEX_SHADER, vsSrc);
        const fs = createShader(gl, gl.FRAGMENT_SHADER, fsSrc);
        if (!vs || !fs) return false;

        const prog = gl.createProgram();
        gl.attachShader(prog, vs);
        gl.attachShader(prog, fs);
        gl.linkProgram(prog);
        if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
            console.warn("Preview program error:", gl.getProgramInfoLog(prog));
            return false;
        }

        gl.useProgram(prog);

        const buf = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, buf);
        // full-screen triangle (fewer verts than quad)
        gl.bufferData(
            gl.ARRAY_BUFFER,
            new Float32Array([-1, -1, 3, -1, -1, 3]),
            gl.STATIC_DRAW,
        );

        const aPos = gl.getAttribLocation(prog, "a_pos");
        gl.enableVertexAttribArray(aPos);
        gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);

        preview.gl = gl;
        preview.prog = prog;
        preview.buf = buf;
        preview.aPos = aPos;

        preview.uTime = gl.getUniformLocation(prog, "u_time");
        preview.uRes = gl.getUniformLocation(prog, "u_res");
        preview.uC1 = gl.getUniformLocation(prog, "u_c1");
        preview.uC2 = gl.getUniformLocation(prog, "u_c2");
        preview.uMouse = gl.getUniformLocation(prog, "u_mouse");

        preview.mode = "webgl";
        return true;
    }

    function initPreview2D(canvas) {
        const ctx = canvas.getContext("2d");
        if (!ctx) return false;
        preview.ctx2d = ctx;
        preview.mode = "2d";
        return true;
    }

    function ensurePreviewRenderer() {
        if (!worksPreviewCanvas) return;
        if (preview.canvas && preview.canvas !== worksPreviewCanvas) {
            preview.mode = "none";
            preview.gl = null;
            preview.ctx2d = null;
            preview.prog = null;
            preview.buf = null;
            preview.canvas = null;
        }
        if (preview.mode !== "none") return;

        // try WebGL first, fallback 2D
        if (!initPreviewWebGL(worksPreviewCanvas)) {
            initPreview2D(worksPreviewCanvas);
        }
        preview.canvas = worksPreviewCanvas;

        // pointer -> mouse
        bindOnce(worksPreviewCanvas, "preview-move", "pointermove", (e) => {
            const r = worksPreviewCanvas.getBoundingClientRect();
            const x = (e.clientX - r.left) / Math.max(1, r.width);
            const y = (e.clientY - r.top) / Math.max(1, r.height);
            preview.mouseTarget = [
                Math.min(1, Math.max(0, x)),
                Math.min(1, Math.max(0, y)),
            ];
        });
        bindOnce(worksPreviewCanvas, "preview-leave", "pointerleave", () => {
            preview.mouseTarget = [0.5, 0.5];
        });
    }

    function resizePreviewCanvas(canvas) {
        if (!canvas) return;
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        const w = Math.max(1, Math.floor(canvas.clientWidth * dpr));
        const h = Math.max(1, Math.floor(canvas.clientHeight * dpr));
        if (canvas.width !== w || canvas.height !== h) {
            canvas.width = w;
            canvas.height = h;
        }
        if (preview.mode === "webgl" && preview.gl) {
            preview.gl.viewport(0, 0, w, h);
        }
    }

    function drawPreview2D(canvas, t) {
        const ctx = preview.ctx2d;
        if (!ctx) return;

        const w = canvas.clientWidth;
        const h = canvas.clientHeight;

        // background gradient
        const g = ctx.createLinearGradient(0, 0, w, h);
        const c1 = `rgba(${Math.floor(preview.c1[0] * 255)},${Math.floor(preview.c1[1] * 255)},${Math.floor(preview.c1[2] * 255)},0.95)`;
        const c2 = `rgba(${Math.floor(preview.c2[0] * 255)},${Math.floor(preview.c2[1] * 255)},${Math.floor(preview.c2[2] * 255)},0.95)`;
        const shift = Math.sin(t * 0.8) * 0.08 + 0.12;
        g.addColorStop(0.0, c1);
        g.addColorStop(Math.min(1, 0.55 + shift), c2);
        g.addColorStop(1.0, "rgba(10,10,10,0.9)");

        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.scale(1, 1);
        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, w, h);

        // grid
        ctx.globalAlpha = 0.1;
        ctx.strokeStyle = "white";
        ctx.lineWidth = 1;
        ctx.beginPath();
        const step = 18;
        for (let x = 0; x < w; x += step) {
            ctx.moveTo(x, 0);
            ctx.lineTo(x, h);
        }
        for (let y = 0; y < h; y += step) {
            ctx.moveTo(0, y);
            ctx.lineTo(w, y);
        }
        ctx.stroke();
        ctx.globalAlpha = 1;
    }

    function tickPreview(now) {
        if (!preview.running || !worksPreviewCanvas) return;

        if (!preview.t0) preview.t0 = now;
        const t = (now - preview.t0) / 1000;

        // lerp colors + mouse
        const lerp = (a, b, k) => a + (b - a) * k;
        const k = 0.07;
        preview.c1 = preview.c1.map((v, i) => lerp(v, preview.targetC1[i], k));
        preview.c2 = preview.c2.map((v, i) => lerp(v, preview.targetC2[i], k));
        preview.mouse = preview.mouse.map((v, i) =>
            lerp(v, preview.mouseTarget[i], 0.1),
        );

        ensurePreviewRenderer();
        resizePreviewCanvas(worksPreviewCanvas);

        if (preview.mode === "webgl" && preview.gl) {
            const gl = preview.gl;
            gl.useProgram(preview.prog);

            const w = worksPreviewCanvas.width;
            const h = worksPreviewCanvas.height;

            gl.uniform1f(preview.uTime, t);
            gl.uniform2f(preview.uRes, w, h);
            gl.uniform3f(
                preview.uC1,
                preview.c1[0],
                preview.c1[1],
                preview.c1[2],
            );
            gl.uniform3f(
                preview.uC2,
                preview.c2[0],
                preview.c2[1],
                preview.c2[2],
            );
            gl.uniform2f(
                preview.uMouse,
                preview.mouse[0],
                1.0 - preview.mouse[1],
            );

            gl.drawArrays(gl.TRIANGLES, 0, 3);
        } else {
            drawPreview2D(worksPreviewCanvas, t);
        }

        preview.raf = requestAnimationFrame(tickPreview);
    }

    function startWorksPreview() {
        if (!worksPreviewCanvas || preview.running) return;
        ensurePreviewRenderer();
        preview.running = true;
        preview.t0 = 0;
        preview.raf = requestAnimationFrame(tickPreview);
        if (!previewResizeBound) {
            previewResizeBound = true;
            window.addEventListener(
                "resize",
                () => resizePreviewCanvas(worksPreviewCanvas),
                {
                    passive: true,
                },
            );
        }
    }

    function stopWorksPreview() {
        preview.running = false;
        if (preview.raf) cancelAnimationFrame(preview.raf);
        preview.raf = 0;
    }

    function maybeStartWorksPreview() {
        if (openMega === "works") startWorksPreview();
    }

    function setWorksPreview({ title, sub, c1, c2 } = {}) {
        if (c1) preview.targetC1 = hexToRgb01(c1);
        if (c2) preview.targetC2 = hexToRgb01(c2);

        // Text
        const changed =
            (title && title !== preview.title) || (sub && sub !== preview.sub);
        if (changed) {
            preview.title = title || preview.title;
            preview.sub = sub || preview.sub;

            if (worksPreviewTitle)
                worksPreviewTitle.textContent = preview.title;
            if (worksPreviewSub) worksPreviewSub.textContent = preview.sub;

            if (!prefersReduced && worksPreviewTitle) {
                gsap.fromTo(
                    [worksPreviewTitle, worksPreviewSub],
                    {
                        opacity: 0,
                        y: 6,
                    },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.18,
                        ease: "power2.out",
                    },
                );
            }
        }
    }

    // Works: hover/focus updates preview + click filter + jump
    function handlePreviewFromEl(el) {
        if (!el) return;
        const title = el.dataset.previewTitle;
        const sub = el.dataset.previewSub;
        const c1 = el.dataset.previewC1;
        const c2 = el.dataset.previewC2;
        setWorksPreview({
            title,
            sub,
            c1,
            c2,
        });
    }

    document.addEventListener(
        "pointerenter",
        (e) => {
            const target = e.target;
            if (!target || typeof target.closest !== "function") return;
            const card = target.closest(".yex-work-card");
            const chip = target.closest(".yex-work-filter");
            if (openMega !== "works") return;
            if (card) handlePreviewFromEl(card);
            if (chip) handlePreviewFromEl(chip);
        },
        true,
    );

    document.addEventListener("focusin", (e) => {
        const target = e.target;
        if (!target || typeof target.closest !== "function") return;
        const card = target.closest(".yex-work-card");
        const chip = target.closest(".yex-work-filter");
        if (openMega !== "works") return;
        if (card) handlePreviewFromEl(card);
        if (chip) handlePreviewFromEl(chip);
    });

    document.addEventListener("click", (e) => {
        const target = e.target;
        if (!target || typeof target.closest !== "function") return;
        const filterBtn = target.closest(".yex-work-filter");
        if (filterBtn) {
            const f = filterBtn.dataset.filter || "all";
            applyWorksFilter(f);
            handlePreviewFromEl(filterBtn);
            return;
        }

        const jumpBtn = target.closest(".yex-work-jump, .yex-work-card");
        if (jumpBtn) {
            const filter = jumpBtn.dataset.filter;
            const jump = jumpBtn.dataset.jump || "#projects";

            hideMega();
            smoothScrollTo(jump);

            if (filter)
                setTimeout(
                    () => applyWorksFilter(filter),
                    prefersReduced ? 0 : 220,
                );
        }
    });
    // ===== Active Nav Indicator =====
    function moveIndicatorTo(el) {
        if (!desktopNav || !navIndicator || !el) return;
        const navRect = desktopNav.getBoundingClientRect();
        const r = el.getBoundingClientRect();
        const x = r.left - navRect.left + r.width * 0.12;
        const w = Math.max(18, r.width * 0.76);

        if (prefersReduced) {
            navIndicator.style.transform = `translateX(${x}px)`;
            navIndicator.style.width = `${w}px`;
            return;
        }
        gsap.to(navIndicator, {
            x,
            width: w,
            duration: 0.25,
            ease: "power3.out",
        });
    }

    function setActiveNav(key) {
        activeNavKey = key;
        const el =
            key === "solutions"
                ? btnSolutions
                : key === "works"
                  ? btnWorks
                  : key === "explore"
                    ? btnExplore
                    : key === "contact"
                      ? navContact
                      : btnWorks;

        moveIndicatorTo(el);
    }
    const navMap = [
        {
            id: "#projects",
            key: "works",
        },
        {
            id: "#services",
            key: "solutions",
        },
        {
            id: "#insights",
            key: "explore",
        },
        {
            id: "#cta",
            key: "contact",
        },
    ];

    function initNavIndicator() {
        if (desktopNav) {
            bindOnce(desktopNav, "nav-over", "pointerover", (e) => {
                const item = e.target.closest("[data-nav-key]");
                if (!item) return;
                moveIndicatorTo(item);
            });
            bindOnce(desktopNav, "nav-leave", "pointerleave", () =>
                setActiveNav(activeNavKey),
            );
        }

        navScrollTriggers.forEach((t) => t.kill());
        navScrollTriggers = [];

        navMap.forEach((m) => {
            const sec = document.querySelector(m.id);
            if (!sec) return;
            navScrollTriggers.push(
                ScrollTrigger.create({
                    trigger: sec,
                    start: "top 40%",
                    end: "bottom 40%",
                    onEnter: () => setActiveNav(m.key),
                    onEnterBack: () => setActiveNav(m.key),
                }),
            );
        });

        setTimeout(() => setActiveNav(activeNavKey || "explore"), 50);
    }

    const doc = document;
    // Logo color animation.
    let logoRects = [];
    const logoSteps = [
        "fill-indigo-300 dark:fill-indigo-600",
        "fill-indigo-400 dark:fill-indigo-500",
        "fill-indigo-500 dark:fill-indigo-400",
        "fill-indigo-600 dark:fill-indigo-300",
        "fill-indigo-700 dark:fill-indigo-200",
    ];

    function initLogoAnimation() {
        logoRects = Array.from(doc.querySelectorAll("[data-logo-rect]"));
        if (logoIntervalId) {
            window.clearInterval(logoIntervalId);
            logoIntervalId = 0;
        }
        logoStep = 0;
        if (!logoRects.length) return;
        logoIntervalId = window.setInterval(() => {
            logoRects.forEach((rect) => {
                const offset = parseInt(
                    rect.getAttribute("data-logo-offset") || "0",
                    10,
                );
                const className =
                    logoSteps[(logoStep + offset) % logoSteps.length];
                rect.setAttribute("class", `transition-fill ${className}`);
            });
            logoStep = (logoStep + 1) % logoSteps.length;
        }, 1000);
    }
    // ---------- Magnetic hover (buttons & small CTAs) ----------
    function initMagnetic() {
        const items = document.querySelectorAll(".yex-magnetic");
        items.forEach((el) => {
            if (el.dataset.yexMagneticInit === "1") return;
            el.dataset.yexMagneticInit = "1";

            let rect;
            const strength = 14;

            function onMove(e) {
                rect = rect || el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                gsap.to(el, {
                    x: (x / rect.width) * strength,
                    y: (y / rect.height) * strength,
                    duration: 0.35,
                    ease: "power3.out",
                });
            }

            function onLeave() {
                rect = null;
                gsap.to(el, {
                    x: 0,
                    y: 0,
                    duration: 0.5,
                    ease: "elastic.out(1,0.4)",
                });
            }
            el.addEventListener(
                "mousemove",
                prefersReduced ? () => {} : onMove,
            );
            el.addEventListener(
                "mouseleave",
                prefersReduced ? () => {} : onLeave,
            );
        });
    }

    // ---------- Reveal animations per section ----------
    function initReveals() {
        const targets = document.querySelectorAll(".yex-reveal");
        targets.forEach((el) => {
            if (el.dataset.yexRevealInit === "1") return;
            el.dataset.yexRevealInit = "1";
            gsap.fromTo(
                el,
                {
                    y: prefersReduced ? 0 : 18,
                    opacity: 0,
                },
                {
                    y: 0,
                    opacity: 1,
                    duration: prefersReduced ? 0 : 0.85,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%",
                    },
                },
            );
        });

        // Cards
        document
            .querySelectorAll(".yex-card, .yex-counter-card")
            .forEach((card) => {
                if (card.dataset.yexCardInit === "1") return;
                card.dataset.yexCardInit = "1";
                gsap.fromTo(
                    card,
                    {
                        y: prefersReduced ? 0 : 20,
                        opacity: 0,
                    },
                    {
                        y: 0,
                        opacity: 1,
                        duration: prefersReduced ? 0 : 0.8,
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: card,
                            start: "top 88%",
                        },
                    },
                );

                // Hover micro-tilt
                if (!prefersReduced) {
                    card.addEventListener("mousemove", (e) => {
                        const r = card.getBoundingClientRect();
                        const rx = ((e.clientY - r.top) / r.height - 0.5) * -6;
                        const ry = ((e.clientX - r.left) / r.width - 0.5) * 8;
                        gsap.to(card, {
                            rotateX: rx,
                            rotateY: ry,
                            transformPerspective: 900,
                            duration: 0.25,
                            ease: "power2.out",
                        });
                    });
                    card.addEventListener("mouseleave", () => {
                        gsap.to(card, {
                            rotateX: 0,
                            rotateY: 0,
                            duration: 0.5,
                            ease: "power3.out",
                        });
                    });
                }
            });

        // Float chips
        document.querySelectorAll(".yex-float").forEach((el, i) => {
            if (prefersReduced) return;
            if (el.dataset.yexFloatInit === "1") return;
            el.dataset.yexFloatInit = "1";
            gsap.to(el, {
                y: -6,
                duration: 2.2 + i * 0.2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
            });
        });
    }

    // ---------- Marquee (clients strip) ----------
    function initMarquee() {
        const row = document.querySelector(".yex-marquee");
        if (!row || prefersReduced) return;
        if (row.dataset.yexMarqueeInit === "1") return;
        row.dataset.yexMarqueeInit = "1";

        // Duplicate content for seamless loop
        row.innerHTML = row.innerHTML + row.innerHTML;
        gsap.to(row, {
            xPercent: -50,
            duration: 18,
            ease: "none",
            repeat: -1,
        });
    }

    // ---------- Count Up ----------
    function initCountUp() {
        const counters = document.querySelectorAll(".yex-counter");
        counters.forEach((el) => {
            if (el.dataset.yexCountInit === "1") return;
            el.dataset.yexCountInit = "1";
            const target = parseInt(el.dataset.target || "0", 10);
            ScrollTrigger.create({
                trigger: el,
                start: "top 85%",
                once: true,
                onEnter: () => {
                    const obj = {
                        val: 0,
                    };
                    gsap.to(obj, {
                        val: target,
                        duration: prefersReduced ? 0 : 1.2,
                        ease: "power2.out",
                        onUpdate: () => {
                            el.textContent = Math.floor(obj.val).toString();
                        },
                    });
                },
            });
        });
    }

    function cleanupScrollTriggers() {
        if (typeof ScrollTrigger === "undefined") return;
        ScrollTrigger.getAll().forEach((t) => {
            if (t.trigger && !t.trigger.isConnected) t.kill();
        });
    }

    function bindCoreHandlers() {
        bindOnce(btnMegaClose, "mega-close", "click", hideMega);
        bindOnce(megaBackdrop, "mega-backdrop", "click", hideMega);

        bindSolTabs();

        bindOnce(btnMobile, "mobile-open", "click", openMobile);
        bindOnce(btnMobileClose, "mobile-close", "click", closeMobile);
        bindOnce(mobileBackdrop, "mobile-backdrop", "click", closeMobile);

        bindOnce(
            projectsSearch,
            "projects-input",
            "input",
            handleProjectsInput,
        );
        bindOnce(
            projectsGrid,
            "projects-grid",
            "click",
            handleProjectsGridClick,
        );
        bindOnce(
            projectModalClose,
            "project-close",
            "click",
            closeProjectModal,
        );
        bindOnce(
            projectModalBackdrop,
            "project-backdrop",
            "click",
            closeProjectModal,
        );
        bindOnce(
            projectModalCopy,
            "project-copy",
            "click",
            handleProjectModalCopy,
        );

        bindOnce(btnSolutions, "mega-sol", "click", () =>
            openMega === "solutions" ? hideMega() : showMega("solutions"),
        );
        bindOnce(btnWorks, "mega-works", "click", () =>
            openMega === "works" ? hideMega() : showMega("works"),
        );
        bindOnce(btnExplore, "mega-explore", "click", () =>
            openMega === "explore" ? hideMega() : showMega("explore"),
        );
    }

    function initCore() {
        refreshCoreDom();
        initThemeToggle();

        openMega = null;
        lastFocus = null;
        activeNavKey = "explore";
        projectsFilter = "all";
        projectsQuery = projectsSearch?.value || "";
        projectModalOpen = false;
        projectModalLastFocus = null;
        mobileCtaShown = false;

        bindCoreHandlers();
        initNavIndicator();
        bindMobileCtaListeners();

        if (mobileCtaBar && !prefersReduced) {
            gsap.set(mobileCtaBar, {
                opacity: 0,
                y: 12,
            });
        }
        updateMobileCta();

        updateProjectsKbdHint();
        applyWorksFilter(projectsFilter);
        if (solTabs.length) activateSolTab("ai");

        preview.title = "";
        preview.sub = "";
        preview.mouse = [0.5, 0.5];
        preview.mouseTarget = [0.5, 0.5];
        setWorksPreview({
            title: "All Works",
            sub: "Highlights across YE portfolio",
            c1: "#7c3aed",
            c2: "#06b6d4",
        });

        initLogoAnimation();
        initMagnetic();
        initReveals();
        initMarquee();
        initCountUp();

        if (typeof ScrollTrigger !== "undefined") ScrollTrigger.refresh();
    }

    function handleLivewireNavigating() {
        if (openMega) hideMega();
        if (mobileDrawer && !mobileDrawer.classList.contains("invisible"))
            closeMobile();
        if (projectModalOpen) closeProjectModal();
        stopWorksPreview();
        disableMegaParallax();
    }

    function handleLivewireNavigated() {
        cleanupScrollTriggers();
        initCore();
    }

    function bindLivewireHandlers() {
        if (livewireHandlersBound) return;
        livewireHandlersBound = true;
        document.addEventListener(
            "livewire:navigate",
            handleLivewireNavigating,
        );
        document.addEventListener(
            "livewire:navigating",
            handleLivewireNavigating,
        );
        document.addEventListener(
            "livewire:navigated",
            handleLivewireNavigated,
        );
    }

    bindLivewireHandlers();
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initCore);
    } else {
        initCore();
    }

    // ---------- WebGL per section (lightweight shader) ----------
    (function webglSections() {
        let instances = [];
        let last = 0;
        let raf = 0;
        let resizeBound = false;

        // Low power hint: if device is weak, reduce framerate
        const isLowPower =
            navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4;

        const VERT = `
    attribute vec2 a_pos;
    varying vec2 v_uv;
    void main() {
        v_uv = (a_pos + 1.0) * 0.5;
        gl_Position = vec4(a_pos, 0.0, 1.0);
    }
    `;

        const FRAG = `
    precision mediump float;
    varying vec2 v_uv;
    uniform vec2 u_res;
    uniform float u_time;
    uniform vec3 u_c1;
    uniform vec3 u_c2;
    uniform float u_scroll;
    uniform float u_boost;

    // cheap hash
    float hash(vec2 p){
        p = fract(p*vec2(123.34, 345.45));
        p += dot(p, p+34.345);
        return fract(p.x*p.y);
    }

    float noise(vec2 p){
        vec2 i = floor(p);
        vec2 f = fract(p);
        float a = hash(i);
        float b = hash(i + vec2(1.0, 0.0));
        float c = hash(i + vec2(0.0, 1.0));
        float d = hash(i + vec2(1.0, 1.0));
        vec2 u = f*f*(3.0-2.0*f);
        return mix(a, b, u.x) + (c-a)*u.y*(1.0-u.x) + (d-b)*u.x*u.y;
    }

    void main(){
        vec2 uv = v_uv;
        float t = u_time * 0.15;

        // subtle warp
        uv.x += 0.04*sin((uv.y*6.0) + t + u_scroll*1.2);
        uv.y += 0.03*cos((uv.x*5.0) - t*1.3);

        float n = noise(uv*4.0 + vec2(t, -t));
        float glow = smoothstep(0.25, 0.95, n);

        vec3 grad = mix(u_c1, u_c2, uv.y + 0.15*sin(t + uv.x*3.0));
        grad += 0.12*vec3(glow);

        // vignette
        vec2 p = (v_uv - 0.5);
        float v = smoothstep(0.9, 0.2, dot(p, p)*1.6);

        vec3 col = grad * v * u_boost;
        col = pow(col, vec3(0.95));

        gl_FragColor = vec4(col, 1.0);
    }
    `;

        function hexToRgb01(hex) {
            const h = hex.replace("#", "").trim();
            const full =
                h.length === 3
                    ? h
                          .split("")
                          .map((c) => c + c)
                          .join("")
                    : h;
            const n = parseInt(full, 16);
            return [
                ((n >> 16) & 255) / 255,
                ((n >> 8) & 255) / 255,
                (n & 255) / 255,
            ];
        }

        function createGL(canvas, c1, c2, boost) {
            const gl = canvas.getContext("webgl", {
                antialias: false,
                alpha: true,
                premultipliedAlpha: true,
            });
            if (!gl) return null;

            function compile(type, src) {
                const sh = gl.createShader(type);
                gl.shaderSource(sh, src);
                gl.compileShader(sh);
                if (!gl.getShaderParameter(sh, gl.COMPILE_STATUS)) {
                    console.warn(gl.getShaderInfoLog(sh));
                    gl.deleteShader(sh);
                    return null;
                }
                return sh;
            }

            const vs = compile(gl.VERTEX_SHADER, VERT);
            const fs = compile(gl.FRAGMENT_SHADER, FRAG);
            if (!vs || !fs) return null;

            const prog = gl.createProgram();
            gl.attachShader(prog, vs);
            gl.attachShader(prog, fs);
            gl.linkProgram(prog);
            if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
                console.warn(gl.getProgramInfoLog(prog));
                return null;
            }
            gl.useProgram(prog);

            const buf = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, buf);
            gl.bufferData(
                gl.ARRAY_BUFFER,
                new Float32Array([-1, -1, 1, -1, -1, 1, -1, 1, 1, -1, 1, 1]),
                gl.STATIC_DRAW,
            );

            const aPos = gl.getAttribLocation(prog, "a_pos");
            gl.enableVertexAttribArray(aPos);
            gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);

            const uRes = gl.getUniformLocation(prog, "u_res");
            const uTime = gl.getUniformLocation(prog, "u_time");
            const uC1 = gl.getUniformLocation(prog, "u_c1");
            const uC2 = gl.getUniformLocation(prog, "u_c2");
            const uScroll = gl.getUniformLocation(prog, "u_scroll");
            const uBoost = gl.getUniformLocation(prog, "u_boost");

            const rgb1 = hexToRgb01(c1);
            const rgb2 = hexToRgb01(c2);

            gl.uniform3f(uC1, rgb1[0], rgb1[1], rgb1[2]);
            gl.uniform3f(uC2, rgb2[0], rgb2[1], rgb2[2]);
            gl.uniform1f(uBoost, boost);

            function resize() {
                const dpr = Math.min(window.devicePixelRatio || 1, 2);
                const w = Math.floor(canvas.clientWidth * dpr);
                const h = Math.floor(canvas.clientHeight * dpr);
                if (canvas.width !== w || canvas.height !== h) {
                    canvas.width = w;
                    canvas.height = h;
                    gl.viewport(0, 0, w, h);
                    gl.uniform2f(uRes, w, h);
                }
            }

            return {
                gl,
                resize,
                draw: (time, scroll01) => {
                    gl.uniform1f(uTime, time);
                    gl.uniform1f(uScroll, scroll01);
                    gl.drawArrays(gl.TRIANGLES, 0, 6);
                },
            };
        }

        function initGlSections() {
            const sections = document.querySelectorAll("[data-gl]");
            if (!sections.length) return;

            sections.forEach((sec) => {
                if (sec.dataset.yexGlInit === "1") return;
                const canvas = sec.querySelector("canvas.yex-gl");
                if (!canvas) return;

                const c1 = sec.dataset.glC1 || "#7c3aed";
                const c2 = sec.dataset.glC2 || "#06b6d4";
                const boost = parseFloat(sec.dataset.glBoost || "1.1");

                const inst = createGL(canvas, c1, c2, boost);
                if (!inst) return;

                sec.dataset.yexGlInit = "1";

                // Render only when section is visible
                let active = false;

                const io = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((e) => (active = e.isIntersecting));
                    },
                    {
                        threshold: 0.08,
                    },
                );
                io.observe(sec);

                instances.push({
                    sec,
                    inst,
                    get active() {
                        return active;
                    },
                });
            });

            if (!resizeBound) {
                window.addEventListener("resize", () =>
                    instances.forEach(({ inst }) => inst.resize()),
                );
                resizeBound = true;
            }

            if (!raf) {
                raf = requestAnimationFrame(loop);
            }
        }

        // Shared render loop
        function loop(tms) {
            const t = tms / 1000;
            const dt = tms - last;

            // throttle on low-power devices
            const throttle = isLowPower ? 40 : 16; // ~25fps vs ~60fps
            if (dt < throttle) {
                raf = requestAnimationFrame(loop);
                return;
            }
            last = tms;

            const docH = Math.max(
                1,
                document.documentElement.scrollHeight - window.innerHeight,
            );
            const scroll01 = window.scrollY / docH;

            instances = instances.filter((entry) => entry.sec?.isConnected);
            instances.forEach(({ sec, inst, active }) => {
                if (!active) return;
                inst.resize();
                inst.draw(t, scroll01);
            });

            raf = requestAnimationFrame(loop);
        }

        initGlSections();
        document.addEventListener("livewire:navigated", initGlSections);
        document.addEventListener("DOMContentLoaded", initGlSections);

        // ---------- Custom cursor ----------
        const isCoarse =
            window.matchMedia && window.matchMedia("(pointer: coarse)").matches;
        if (cursor && cursorDot && cursorRing && !isCoarse) {
            const qx = gsap.quickTo(cursorRing, "x", {
                duration: 0.22,
                ease: "power3.out",
            });
            const qy = gsap.quickTo(cursorRing, "y", {
                duration: 0.22,
                ease: "power3.out",
            });
            const qdx = gsap.quickTo(cursorDot, "x", {
                duration: 0.06,
                ease: "power3.out",
            });
            const qdy = gsap.quickTo(cursorDot, "y", {
                duration: 0.06,
                ease: "power3.out",
            });

            let visible = false;

            function showCursor() {
                if (visible) return;
                visible = true;
                gsap.to(cursor, {
                    opacity: 1,
                    duration: 0.18,
                    ease: "power2.out",
                });
            }

            function hideCursor() {
                visible = false;
                gsap.to(cursor, {
                    opacity: 0,
                    duration: 0.18,
                    ease: "power2.out",
                });
            }

            document.addEventListener("pointermove", (e) => {
                showCursor();
                qx(e.clientX);
                qy(e.clientY);
                qdx(e.clientX);
                qdy(e.clientY);
            });
            document.addEventListener("pointerleave", hideCursor);

            function setCursorState(state) {
                if (prefersReduced) return;
                if (state === "link") {
                    gsap.to(cursorRing, {
                        scale: 1.35,
                        duration: 0.22,
                        ease: "power3.out",
                    });
                    gsap.to(cursorDot, {
                        scale: 0.7,
                        duration: 0.22,
                        ease: "power3.out",
                    });
                } else if (state === "press") {
                    gsap.to(cursorRing, {
                        scale: 0.9,
                        duration: 0.16,
                        ease: "power2.out",
                    });
                    gsap.to(cursorDot, {
                        scale: 1.3,
                        duration: 0.16,
                        ease: "power2.out",
                    });
                } else {
                    gsap.to(cursorRing, {
                        scale: 1,
                        duration: 0.22,
                        ease: "power3.out",
                    });
                    gsap.to(cursorDot, {
                        scale: 1,
                        duration: 0.22,
                        ease: "power3.out",
                    });
                }
            }

            document.addEventListener("pointerdown", () =>
                setCursorState("press"),
            );
            document.addEventListener("pointerup", () =>
                setCursorState("default"),
            );

            const interactSel =
                "a,button,.yex-magnetic,.yex-card,input,textarea,select,[role='button']";

            function bindCursorInteractions() {
                document.querySelectorAll(interactSel).forEach((el) => {
                    bindOnce(el, "cursor-enter", "pointerenter", () => {
                        setCursorState("link");
                        Sound.hoverTick();
                    });
                    bindOnce(el, "cursor-leave", "pointerleave", () =>
                        setCursorState("default"),
                    );
                });
            }
            bindCursorInteractions();
            document.addEventListener(
                "livewire:navigated",
                bindCursorInteractions,
            );
        }

        // =========================
        // ABOUT PAGE: story HUD + boot + overlay + console + animations
        // =========================
        function initAboutPage() {
            const hero = document.getElementById("about-hero");
            if (!hero) return;
            if (hero.dataset.yexAboutInit === "1") return;
            hero.dataset.yexAboutInit = "1";

            // ---------- HUD elements ----------
            const hudEls = Array.from(
                document.querySelectorAll("[data-boot-hide]"),
            );
            const chapters = document.getElementById("yexChapters");
            const chapterBtns = gsap.utils.toArray(".yex-ch-btn");
            const chapterIndicator = document.getElementById(
                "yexChapterIndicator",
            );

            // Aten7-ish dock + dial
            const dock = document.getElementById("yexDock");
            const dockBtns = gsap.utils.toArray(".yex-dock-btn");
            const dial = document.getElementById("yexDial");
            const dialProgress = document.getElementById("yexDialProgress");
            const dialLabel = document.getElementById("yexDialLabel");

            const soundToggle = document.getElementById("yexSoundToggle");
            const soundToggleMobile = document.getElementById(
                "yexSoundToggleMobile",
            );

            const cursor = document.getElementById("yexCursor");
            const cursorDot = document.getElementById("yexCursorDot");
            const cursorRing = document.getElementById("yexCursorRing");

            // ---------- Overlay (chapter transitions) ----------
            const chOverlay = document.getElementById("yexChapterOverlay");
            const chKicker = document.getElementById("yexChapterKicker");
            const chTitle = document.getElementById("yexChapterTitle");
            const chSub = document.getElementById("yexChapterSub");

            // ---------- Terminal (console) ----------
            const term = document.getElementById("yexTerminal");
            const termStatus = document.getElementById("yexTerminalStatus");
            const termActive = document.getElementById("yexTerminalActive");
            const termSignal = document.getElementById("yexTerminalSignal");
            const termLog = document.getElementById("yexTerminalLog");

            // ---------- Chapter meta ----------
            const chapterMeta = {
                "#about-hero": {
                    n: "01",
                    title: "Hero",
                    sub: "Boot into YE story. Reveal + parallax glow.",
                },
                "#story": {
                    n: "02",
                    title: "Story",
                    sub: "Visi, misi, beliefs — dalam format naratif.",
                },
                "#timeline": {
                    n: "03",
                    title: "Timeline",
                    sub: "Milestone delivery dan evolusi kapabilitas.",
                },
                "#values": {
                    n: "04",
                    title: "Values",
                    sub: "Spotlight cards — values yang terasa hidup.",
                },
                "#team": {
                    n: "05",
                    title: "Team",
                    sub: "Hover tilt + glow. Culture yang bisa dirasakan.",
                },
                "#cta": {
                    n: "06",
                    title: "CTA",
                    sub: "Let’s ship — dan tetap stable.",
                },
            };

            // ---------- Utilities ----------
            const pad2 = (v) => String(v).padStart(2, "0");

            function ts() {
                const d = new Date();
                return `${pad2(d.getHours())}:${pad2(d.getMinutes())}:${pad2(d.getSeconds())}`;
            }

            function setStatus(text) {
                if (termStatus) termStatus.textContent = text;
            }

            function setSignal(text) {
                if (termSignal) termSignal.textContent = text;
            }

            function addLog(message, level = "ok") {
                if (!termLog) return;

                const li = document.createElement("li");
                li.className = "flex items-start gap-2";
                li.innerHTML = `
      <span class="yex-log-dot ${level}"></span>
      <span class="opacity-70">[${ts()}]</span>
      <span class="ml-1">${message}</span>
    `;

                termLog.appendChild(li);

                if (!prefersReduced) {
                    gsap.fromTo(
                        li,
                        {
                            opacity: 0,
                            y: 8,
                        },
                        {
                            opacity: 1,
                            y: 0,
                            duration: 0.22,
                            ease: "power2.out",
                        },
                    );
                }

                // keep last 10
                while (termLog.children.length > 10)
                    termLog.removeChild(termLog.firstElementChild);

                // scroll bottom
                termLog.scrollTop = termLog.scrollHeight;
            }

            function setActiveConsole(sel) {
                const meta = chapterMeta[sel];
                if (!meta) return;
                if (termActive)
                    termActive.textContent = `${meta.n} • ${meta.title}`;
                setStatus(`chapter ${meta.n}`);
            }

            // ---------- Micro sound (Web Audio, mute-able) ----------
            const Sound = (() => {
                let ctx = null;
                let enabled = localStorage.getItem("yexSound") === "1";

                function ensure() {
                    if (!enabled) return null;
                    if (!ctx) {
                        const AC =
                            window.AudioContext || window.webkitAudioContext;
                        if (!AC) return null;
                        ctx = new AC();
                    }
                    if (ctx.state === "suspended") ctx.resume();
                    return ctx;
                }

                function beep({
                    type = "triangle",
                    f0 = 220,
                    f1 = 140,
                    dur = 0.06,
                    vol = 0.05,
                } = {}) {
                    const c = ensure();
                    if (!c) return;

                    const t = c.currentTime;
                    const o = c.createOscillator();
                    const g = c.createGain();

                    o.type = type;
                    o.frequency.setValueAtTime(f0, t);
                    o.frequency.exponentialRampToValueAtTime(
                        Math.max(20, f1),
                        t + dur,
                    );

                    g.gain.setValueAtTime(0.0001, t);
                    g.gain.exponentialRampToValueAtTime(vol, t + 0.008);
                    g.gain.exponentialRampToValueAtTime(0.0001, t + dur);

                    o.connect(g);
                    g.connect(c.destination);
                    o.start(t);
                    o.stop(t + dur + 0.01);
                }

                let lastHover = 0;

                function hoverTick() {
                    const now = performance.now();
                    if (now - lastHover < 120) return;
                    lastHover = now;
                    beep({
                        type: "triangle",
                        f0: 420,
                        f1: 260,
                        dur: 0.045,
                        vol: 0.03,
                    });
                }

                function clickTick() {
                    beep({
                        type: "sine",
                        f0: 220,
                        f1: 90,
                        dur: 0.07,
                        vol: 0.05,
                    });
                }

                function setEnabled(v) {
                    enabled = !!v;
                    localStorage.setItem("yexSound", enabled ? "1" : "0");
                }

                function isEnabled() {
                    return enabled;
                }

                return {
                    ensure,
                    hoverTick,
                    clickTick,
                    setEnabled,
                    isEnabled,
                };
            })();

            function syncSoundLabel() {
                const label = Sound.isEnabled() ? "Sound: On" : "Sound: Off";
                if (soundToggle) soundToggle.textContent = label;
                if (soundToggleMobile) soundToggleMobile.textContent = label;
            }
            syncSoundLabel();

            function toggleSound() {
                Sound.setEnabled(!Sound.isEnabled());
                syncSoundLabel();
                Sound.clickTick();
                addLog(
                    `sound ${Sound.isEnabled() ? "enabled" : "disabled"}`,
                    Sound.isEnabled() ? "ok" : "warn",
                );
            }
            soundToggle?.addEventListener("click", toggleSound);
            soundToggleMobile?.addEventListener("click", toggleSound);

            // Browser policy: resume after gesture
            window.addEventListener("pointerdown", () => Sound.ensure(), {
                once: true,
            });

            // ---------- Boot intro ----------
            const boot = document.getElementById("aboutBoot");
            const bootSkip = document.getElementById("bootSkip");
            const bootLines = gsap.utils.toArray("[data-boot-line]");

            function showHUD() {
                hudEls.forEach((el) =>
                    el.classList.remove("pointer-events-none"),
                );

                if (prefersReduced) {
                    hudEls.forEach((el) => el.classList.remove("opacity-0"));
                    if (chapterIndicator) chapterIndicator.style.opacity = "1";
                    addLog("boot complete", "ok");
                    return;
                }

                gsap.to(hudEls, {
                    opacity: 1,
                    duration: 0.35,
                    ease: "power2.out",
                    stagger: 0.03,
                });
                addLog("boot complete", "ok");
            }

            function hideBoot() {
                if (!boot) {
                    showHUD();
                    return;
                }
                boot.setAttribute("aria-hidden", "true");
                gsap.to(boot, {
                    opacity: 0,
                    duration: prefersReduced ? 0 : 0.35,
                    ease: "power2.out",
                    onComplete: () => boot.remove(),
                });
                showHUD();
                setTimeout(() => ScrollTrigger.refresh(), 60);
            }

            bootSkip?.addEventListener("click", () => {
                addLog("intro skipped", "warn");
                hideBoot();
            });

            if (boot) {
                if (prefersReduced) {
                    hideBoot();
                } else {
                    gsap.set(bootLines, {
                        opacity: 0,
                        y: 6,
                        filter: "blur(6px)",
                    });
                    gsap.timeline()
                        .to(bootLines, {
                            opacity: 1,
                            y: 0,
                            filter: "blur(0px)",
                            duration: 0.35,
                            ease: "power3.out",
                            stagger: 0.22,
                            clearProps: "filter",
                        })
                        .to(
                            {},
                            {
                                duration: 0.35,
                            },
                        )
                        .add(hideBoot);
                }
            } else {
                showHUD();
            }

            // ---------- Hero reveal ----------
            const heroLines = gsap.utils.toArray(".about-hero-line");
            if (!prefersReduced) {
                gsap.set(heroLines, {
                    opacity: 0,
                    y: 14,
                    filter: "blur(8px)",
                });
                gsap.to(heroLines, {
                    opacity: 1,
                    y: 0,
                    filter: "blur(0px)",
                    duration: 0.9,
                    ease: "power3.out",
                    stagger: 0.12,
                    delay: 0.05,
                    clearProps: "filter",
                });
            } else {
                gsap.set(heroLines, {
                    opacity: 1,
                    y: 0,
                });
            }

            // ---------- Parallax glow ----------
            const glow = document.getElementById("aboutGlow");
            if (glow && !prefersReduced) {
                const qx = gsap.quickTo(glow, "x", {
                    duration: 0.45,
                    ease: "power3.out",
                });
                const qy = gsap.quickTo(glow, "y", {
                    duration: 0.45,
                    ease: "power3.out",
                });
                const qs = gsap.quickTo(glow, "scale", {
                    duration: 0.55,
                    ease: "power3.out",
                });

                hero.addEventListener("pointermove", (e) => {
                    const r = hero.getBoundingClientRect();
                    const px =
                        (e.clientX - r.left) / Math.max(1, r.width) - 0.5;
                    const py =
                        (e.clientY - r.top) / Math.max(1, r.height) - 0.5;
                    qx(px * 60);
                    qy(py * 50);
                    qs(1.02);
                });

                hero.addEventListener("pointerleave", () => {
                    gsap.to(glow, {
                        x: 0,
                        y: 0,
                        scale: 1,
                        duration: 0.8,
                        ease: "power3.out",
                    });
                });

                gsap.to(glow, {
                    y: 80,
                    scrollTrigger: {
                        trigger: hero,
                        start: "top top",
                        end: "bottom top",
                        scrub: 0.6,
                    },
                });
            }

            // ---------- Chapter Overlay Transition ----------
            let lastFlashAt = 0;

            function flashChapter(sel) {
                const meta = chapterMeta[sel];
                if (!meta || !chOverlay || !chTitle || !chSub || !chKicker)
                    return;

                const now = performance.now();
                if (now - lastFlashAt < 550) return; // anti spam
                lastFlashAt = now;

                chTitle.textContent = `${meta.n} • ${meta.title}`;
                chSub.textContent = meta.sub;

                if (prefersReduced) return;

                gsap.killTweensOf([chOverlay, chTitle, chSub, chKicker]);

                // quick "chapter flash" ~ 200ms feel + graceful fade out
                gsap.set(chOverlay, {
                    opacity: 0,
                });
                gsap.set([chKicker, chTitle, chSub], {
                    opacity: 0,
                    y: 14,
                    filter: "blur(10px)",
                });

                const tl = gsap.timeline();
                tl.to(
                    chOverlay,
                    {
                        opacity: 1,
                        duration: 0.12,
                        ease: "power2.out",
                    },
                    0,
                )
                    .to(
                        chKicker,
                        {
                            opacity: 1,
                            y: 0,
                            filter: "blur(0px)",
                            duration: 0.18,
                            ease: "power3.out",
                        },
                        0.03,
                    )
                    .to(
                        chTitle,
                        {
                            opacity: 1,
                            y: 0,
                            filter: "blur(0px)",
                            duration: 0.22,
                            ease: "power3.out",
                        },
                        0.06,
                    )
                    .to(
                        chSub,
                        {
                            opacity: 1,
                            y: 0,
                            filter: "blur(0px)",
                            duration: 0.22,
                            ease: "power3.out",
                        },
                        0.08,
                    )
                    .to(
                        {},
                        {
                            duration: 0.18,
                        },
                    )
                    .to(
                        chOverlay,
                        {
                            opacity: 0,
                            duration: 0.28,
                            ease: "power2.out",
                        },
                        ">-0.02",
                    )
                    .set([chKicker, chTitle, chSub], {
                        clearProps: "filter",
                    });

                addLog(`transition → ${meta.title.toLowerCase()}`, "ok");
                Sound.clickTick();
            }

            // ---------- Chapters: active + indicator + click scroll ----------
            function setActiveChapter(btn) {
                chapterBtns.forEach((b) =>
                    b.classList.toggle("is-active", b === btn),
                );

                const sel = btn?.getAttribute("data-ch");
                // sync dock active state (mobile + desktop)
                if (sel && dockBtns?.length) {
                    dockBtns.forEach((b) =>
                        b.classList.toggle(
                            "is-active",
                            b.getAttribute("data-ch") === sel,
                        ),
                    );
                }
                if (sel) setActiveConsole(sel);

                if (!chapters || !chapterIndicator || !btn) return;

                const navRect = chapters.getBoundingClientRect();
                const btnRect = btn.getBoundingClientRect();
                const y = btnRect.top - navRect.top + 6;

                if (prefersReduced) {
                    chapterIndicator.style.opacity = "1";
                    chapterIndicator.style.transform = `translateY(${y}px)`;
                    return;
                }

                gsap.to(chapterIndicator, {
                    opacity: 1,
                    duration: 0.18,
                    ease: "power2.out",
                });
                gsap.to(chapterIndicator, {
                    y,
                    duration: 0.28,
                    ease: "power3.out",
                });
            }

            chapterBtns.forEach((btn) => {
                const sel = btn.getAttribute("data-ch");
                const target = sel ? document.querySelector(sel) : null;
                if (!target) return;

                btn.addEventListener("click", () => {
                    Sound.clickTick();
                    addLog(
                        `navigate → ${chapterMeta[sel]?.title || sel}`,
                        "ok",
                    );

                    gsap.to(window, {
                        duration: prefersReduced ? 0 : 0.95,
                        ease: "power3.out",
                        scrollTo: {
                            y: target,
                            offsetY: 88,
                        },
                    });
                });

                ScrollTrigger.create({
                    trigger: target,
                    start: "top center",
                    end: "bottom center",
                    onEnter: () => {
                        setActiveChapter(btn);
                        flashChapter(sel);
                    },
                    onEnterBack: () => {
                        setActiveChapter(btn);
                        flashChapter(sel);
                    },
                });
            });

            // Dock: quick navigation (Aten7-ish)
            dockBtns.forEach((btn) => {
                const sel = btn.getAttribute("data-ch");
                const target = sel ? document.querySelector(sel) : null;
                if (!target) return;

                btn.addEventListener("click", () => {
                    Sound.clickTick();
                    addLog(
                        `navigate → ${chapterMeta[sel]?.title || sel}`,
                        "ok",
                    );
                    gsap.to(window, {
                        duration: prefersReduced ? 0 : 0.95,
                        ease: "power3.out",
                        scrollTo: {
                            y: target,
                            offsetY: 88,
                        },
                    });
                });
            });

            if (chapterBtns[0]) setActiveChapter(chapterBtns[0]);

            // ---------- Scroll Dial: progress + jump to next chapter ----------
            if (dial && dialProgress) {
                try {
                    const len = dialProgress.getTotalLength();
                    dialProgress.style.strokeDasharray = String(len);
                    dialProgress.style.strokeDashoffset = String(len);

                    const endEl =
                        document.querySelector("#cta") || document.body;
                    ScrollTrigger.create({
                        trigger: hero,
                        start: "top top",
                        endTrigger: endEl,
                        end: "bottom bottom",
                        onUpdate: (self) => {
                            dialProgress.style.strokeDashoffset = String(
                                len * (1 - self.progress),
                            );
                            if (dialLabel)
                                dialLabel.textContent =
                                    self.progress > 0.92 ? "END" : "NEXT";
                        },
                    });

                    dial.addEventListener("click", () => {
                        Sound.clickTick();

                        const order = [
                            "#about-hero",
                            "#story",
                            "#timeline",
                            "#values",
                            "#team",
                            "#cta",
                        ];
                        const activeBtn =
                            chapterBtns.find((b) =>
                                b.classList.contains("is-active"),
                            ) ||
                            dockBtns.find((b) =>
                                b.classList.contains("is-active"),
                            );
                        const activeSel =
                            activeBtn?.getAttribute("data-ch") || "#about-hero";

                        const idx = Math.max(0, order.indexOf(activeSel));
                        const nextSel =
                            order[Math.min(order.length - 1, idx + 1)];
                        const target = document.querySelector(nextSel);
                        if (!target) return;

                        gsap.to(window, {
                            duration: prefersReduced ? 0 : 0.9,
                            ease: "power3.out",
                            scrollTo: {
                                y: target,
                                offsetY: 88,
                            },
                        });
                    });
                } catch {
                    // ignore dial if path unsupported
                }
            }

            // ---------- Timeline progress + active label ----------
            const tlSec = document.getElementById("timeline");
            const tlProgress = document.getElementById("tlProgress");
            const tlActiveLabel = document.getElementById("tlActiveLabel");
            const items = gsap.utils.toArray(".yex-tl-item");

            let lastMilestone = "";

            function setActiveMilestone(item) {
                items.forEach((el) =>
                    el.classList.toggle("is-active", el === item),
                );
                if (!item) return;

                const y = item.dataset.year || "";
                const t = item.dataset.title || "";
                const label = `${y} • ${t}`.trim();

                if (tlActiveLabel) tlActiveLabel.textContent = label;

                if (label && label !== lastMilestone) {
                    lastMilestone = label;
                    addLog(`milestone: ${label}`, "ok");
                    setSignal("timeline sync");
                    setTimeout(() => setSignal("ok"), 650);
                }
            }

            if (tlSec && tlProgress) {
                if (prefersReduced) {
                    gsap.set(tlProgress, {
                        scaleY: 1,
                    });
                    if (items[0]) setActiveMilestone(items[0]);
                } else {
                    gsap.fromTo(
                        tlProgress,
                        {
                            scaleY: 0,
                        },
                        {
                            scaleY: 1,
                            ease: "none",
                            scrollTrigger: {
                                trigger: tlSec,
                                start: "top 75%",
                                end: "bottom 25%",
                                scrub: true,
                            },
                        },
                    );

                    items.forEach((item, i) => {
                        ScrollTrigger.create({
                            trigger: item,
                            start: "top center",
                            end: "bottom center",
                            onEnter: () => setActiveMilestone(item),
                            onEnterBack: () => setActiveMilestone(item),
                        });
                        if (i === 0) setActiveMilestone(item);
                    });
                }
            }

            // ---------- Values spotlight follow ----------
            const spotlightCards = gsap.utils.toArray(".yex-spotlight-card");
            spotlightCards.forEach((card) => {
                card.addEventListener("pointermove", (e) => {
                    const r = card.getBoundingClientRect();
                    const x =
                        ((e.clientX - r.left) / Math.max(1, r.width)) * 100;
                    const y =
                        ((e.clientY - r.top) / Math.max(1, r.height)) * 100;
                    card.style.setProperty("--mx", `${x}%`);
                    card.style.setProperty("--my", `${y}%`);
                });
                card.addEventListener("pointerleave", () => {
                    card.style.setProperty("--mx", `50%`);
                    card.style.setProperty("--my", `35%`);
                });
            });

            // ---------- CTA lines ----------
            const ctaLines = gsap.utils.toArray(".cta-line");
            ctaLines.forEach((el) => {
                if (prefersReduced) {
                    gsap.set(el, {
                        opacity: 1,
                        y: 0,
                    });
                    return;
                }
                gsap.fromTo(
                    el,
                    {
                        opacity: 0,
                        y: 14,
                    },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.75,
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: el,
                            start: "top 85%",
                        },
                    },
                );
            });

            // ---------- Terminal initial boot lines ----------
            addLog("console online", "ok");
            addLog("gsap + scrolltrigger ready", "ok");
            addLog(
                `reduced motion: ${prefersReduced ? "yes" : "no"}`,
                prefersReduced ? "warn" : "ok",
            );

            // Also update year if exists
            const y = document.getElementById("year");
            if (y) y.textContent = new Date().getFullYear();
        }
        initAboutPage();
        document.addEventListener("livewire:navigated", initAboutPage);
        /* =========================================================
   YEX ABOUT + HISTORY (GSAP + WebAudio + Drag Timeline)
   Paste this block at the VERY END of ye.js
   ========================================================= */
        (function YEX_AboutHistory() {
            if (typeof window === "undefined") return;
            if (typeof gsap === "undefined") return;

            // Plugins are already registered in your ye.js, but safe to call
            try {
                gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
            } catch {}

            const prefersReducedLocal =
                window.matchMedia &&
                window.matchMedia("(prefers-reduced-motion: reduce)").matches;

            // -------------------------
            // Shared micro-sound (WebAudio) singleton
            // uses localStorage key: "yexSound" (1/0)
            // -------------------------
            const Sound =
                window.YEXSound ||
                (window.YEXSound = (function () {
                    let ctx = null;
                    let enabled = localStorage.getItem("yexSound") === "1";

                    function ensure() {
                        if (!enabled) return null;
                        const AC =
                            window.AudioContext || window.webkitAudioContext;
                        if (!AC) return null;
                        if (!ctx) ctx = new AC();
                        if (ctx.state === "suspended") ctx.resume();
                        return ctx;
                    }

                    function beep({
                        type = "triangle",
                        f0 = 220,
                        f1 = 140,
                        dur = 0.06,
                        vol = 0.05,
                    } = {}) {
                        const c = ensure();
                        if (!c) return;

                        const t = c.currentTime;
                        const o = c.createOscillator();
                        const g = c.createGain();

                        o.type = type;
                        o.frequency.setValueAtTime(f0, t);
                        o.frequency.exponentialRampToValueAtTime(
                            Math.max(20, f1),
                            t + dur,
                        );

                        g.gain.setValueAtTime(0.0001, t);
                        g.gain.exponentialRampToValueAtTime(vol, t + 0.008);
                        g.gain.exponentialRampToValueAtTime(0.0001, t + dur);

                        o.connect(g);
                        g.connect(c.destination);
                        o.start(t);
                        o.stop(t + dur + 0.01);
                    }

                    let lastHover = 0;

                    function hoverTick() {
                        const now = performance.now();
                        if (now - lastHover < 120) return;
                        lastHover = now;
                        beep({
                            type: "triangle",
                            f0: 420,
                            f1: 260,
                            dur: 0.045,
                            vol: 0.03,
                        });
                    }

                    function clickTick() {
                        beep({
                            type: "sine",
                            f0: 220,
                            f1: 90,
                            dur: 0.07,
                            vol: 0.05,
                        });
                    }

                    function setEnabled(v) {
                        enabled = !!v;
                        localStorage.setItem("yexSound", enabled ? "1" : "0");
                    }

                    function isEnabled() {
                        return enabled;
                    }

                    return {
                        ensure,
                        hoverTick,
                        clickTick,
                        setEnabled,
                        isEnabled,
                    };
                })());

            // Browser policy: resume after first gesture
            window.addEventListener("pointerdown", () => Sound.ensure(), {
                once: true,
            });

            // -------------------------
            // ABOUT PAGE INIT (if #about-hero exists)
            // -------------------------
            (function initAbout() {
                const hero = document.getElementById("about-hero");
                if (!hero) return;
                if (hero.dataset.yexAboutInit === "1") return;
                hero.dataset.yexAboutInit = "1";

                const chapters = document.getElementById("yexChapters");
                const chapterBtns = gsap.utils.toArray(".yex-ch-btn");
                const chapterIndicator = document.getElementById(
                    "yexChapterIndicator",
                );

                const dockBtns = gsap.utils.toArray(".yex-dock-btn");
                const dial = document.getElementById("yexDial");
                const dialProgress = document.getElementById("yexDialProgress");
                const dialLabel = document.getElementById("yexDialLabel");

                const overlay = document.getElementById("yexChapterOverlay");
                const ovKicker = document.getElementById("yexChapterKicker");
                const ovTitle = document.getElementById("yexChapterTitle");
                const ovSub = document.getElementById("yexChapterSub");

                const soundToggle = document.getElementById("yexSoundToggle");
                const soundToggleMobile = document.getElementById(
                    "yexSoundToggleMobile",
                );

                const boot = document.getElementById("aboutBoot");
                const bootSkip = document.getElementById("bootSkip");
                const bootLines = gsap.utils.toArray("[data-boot-line]");
                const hudEls = Array.from(
                    document.querySelectorAll("[data-boot-hide]"),
                );

                // match section order di about.blade.php
                const chapterMeta = {
                    "#about-hero": {
                        n: "01",
                        title: "Banner",
                        sub: "Brand intro + parallax glow + WebGL.",
                    },
                    "#story": {
                        n: "02",
                        title: "Scale",
                        sub: "Count up + Visi & Misi.",
                    },
                    "#values": {
                        n: "03",
                        title: "Beliefs",
                        sub: "Spotlight values cards.",
                    },
                    "#timeline": {
                        n: "04",
                        title: "Histories",
                        sub: "Milestones preview + Discover More.",
                    },
                    "#team": {
                        n: "05",
                        title: "Leadership",
                        sub: "Team cards + tilt micro-interactions.",
                    },
                    "#cta": {
                        n: "06",
                        title: "Contact",
                        sub: "CTA untuk kolaborasi.",
                    },
                };

                function syncSoundLabel() {
                    const label = Sound.isEnabled()
                        ? "Sound: On"
                        : "Sound: Off";
                    if (soundToggle) soundToggle.textContent = label;
                    if (soundToggleMobile)
                        soundToggleMobile.textContent = label;
                }
                syncSoundLabel();

                function toggleSound() {
                    Sound.setEnabled(!Sound.isEnabled());
                    syncSoundLabel();
                    Sound.clickTick();
                }
                soundToggle?.addEventListener("click", toggleSound);
                soundToggleMobile?.addEventListener("click", toggleSound);

                function showHUD() {
                    hudEls.forEach((el) =>
                        el.classList.remove("pointer-events-none"),
                    );
                    if (prefersReducedLocal) {
                        hudEls.forEach((el) =>
                            el.classList.remove("opacity-0"),
                        );
                        return;
                    }
                    gsap.to(hudEls, {
                        opacity: 1,
                        duration: 0.35,
                        ease: "power2.out",
                        stagger: 0.03,
                    });
                }

                function hideBoot() {
                    if (!boot) {
                        showHUD();
                        return;
                    }
                    boot.setAttribute("aria-hidden", "true");
                    gsap.to(boot, {
                        opacity: 0,
                        duration: prefersReducedLocal ? 0 : 0.35,
                        ease: "power2.out",
                        onComplete: () => boot.remove(),
                    });
                    showHUD();
                    setTimeout(() => ScrollTrigger.refresh(), 60);
                }

                bootSkip?.addEventListener("click", hideBoot);

                if (boot) {
                    if (prefersReducedLocal) hideBoot();
                    else {
                        gsap.set(bootLines, {
                            opacity: 0,
                            y: 6,
                            filter: "blur(6px)",
                        });
                        gsap.timeline()
                            .to(bootLines, {
                                opacity: 1,
                                y: 0,
                                filter: "blur(0px)",
                                duration: 0.35,
                                ease: "power3.out",
                                stagger: 0.22,
                                clearProps: "filter",
                            })
                            .to(
                                {},
                                {
                                    duration: 0.25,
                                },
                            )
                            .add(hideBoot);
                    }
                } else showHUD();

                // hero reveal
                const heroLines = gsap.utils.toArray(".about-hero-line");
                if (!prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(8px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        delay: 0.05,
                        clearProps: "filter",
                    });
                }

                // chapter flash overlay
                let lastFlash = 0;

                function flash(sel) {
                    const meta = chapterMeta[sel];
                    if (!meta || !overlay || !ovTitle || !ovSub || !ovKicker)
                        return;

                    const now = performance.now();
                    if (now - lastFlash < 500) return;
                    lastFlash = now;

                    ovKicker.textContent = "CHAPTER";
                    ovTitle.textContent = `${meta.n} • ${meta.title}`;
                    ovSub.textContent = meta.sub;

                    if (prefersReducedLocal) return;

                    gsap.killTweensOf([overlay, ovKicker, ovTitle, ovSub]);
                    gsap.set(overlay, {
                        opacity: 0,
                    });
                    gsap.set([ovKicker, ovTitle, ovSub], {
                        opacity: 0,
                        y: 14,
                        filter: "blur(10px)",
                    });

                    gsap.timeline()
                        .to(
                            overlay,
                            {
                                opacity: 1,
                                duration: 0.12,
                                ease: "power2.out",
                            },
                            0,
                        )
                        .to(
                            ovKicker,
                            {
                                opacity: 1,
                                y: 0,
                                filter: "blur(0px)",
                                duration: 0.18,
                                ease: "power3.out",
                            },
                            0.03,
                        )
                        .to(
                            ovTitle,
                            {
                                opacity: 1,
                                y: 0,
                                filter: "blur(0px)",
                                duration: 0.22,
                                ease: "power3.out",
                            },
                            0.06,
                        )
                        .to(
                            ovSub,
                            {
                                opacity: 1,
                                y: 0,
                                filter: "blur(0px)",
                                duration: 0.22,
                                ease: "power3.out",
                            },
                            0.08,
                        )
                        .to(
                            {},
                            {
                                duration: 0.18,
                            },
                        )
                        .to(
                            overlay,
                            {
                                opacity: 0,
                                duration: 0.28,
                                ease: "power2.out",
                            },
                            ">-0.02",
                        )
                        .set([ovKicker, ovTitle, ovSub], {
                            clearProps: "filter",
                        });

                    Sound.clickTick();
                }

                function setActiveBtn(btn) {
                    if (!btn) return;
                    chapterBtns.forEach((b) =>
                        b.classList.toggle("is-active", b === btn),
                    );

                    const sel = btn.getAttribute("data-ch");
                    if (sel)
                        dockBtns.forEach((b) =>
                            b.classList.toggle(
                                "is-active",
                                b.getAttribute("data-ch") === sel,
                            ),
                        );

                    if (chapters && chapterIndicator) {
                        const navRect = chapters.getBoundingClientRect();
                        const btnRect = btn.getBoundingClientRect();
                        const y = btnRect.top - navRect.top + 6;

                        if (prefersReducedLocal) {
                            chapterIndicator.style.opacity = "1";
                            chapterIndicator.style.transform = `translateY(${y}px)`;
                        } else {
                            gsap.to(chapterIndicator, {
                                opacity: 1,
                                duration: 0.18,
                                ease: "power2.out",
                            });
                            gsap.to(chapterIndicator, {
                                y,
                                duration: 0.28,
                                ease: "power3.out",
                            });
                        }
                    }
                }

                // bind chapter clicks + scroll spy
                chapterBtns.forEach((btn) => {
                    const sel = btn.getAttribute("data-ch");
                    const target = sel ? document.querySelector(sel) : null;
                    if (!target) return;

                    btn.addEventListener("click", () => {
                        Sound.clickTick();
                        gsap.to(window, {
                            duration: prefersReducedLocal ? 0 : 0.95,
                            ease: "power3.out",
                            scrollTo: {
                                y: target,
                                offsetY: 88,
                            },
                        });
                    });

                    ScrollTrigger.create({
                        trigger: target,
                        start: "top center",
                        end: "bottom center",
                        onEnter: () => {
                            setActiveBtn(btn);
                            flash(sel);
                        },
                        onEnterBack: () => {
                            setActiveBtn(btn);
                            flash(sel);
                        },
                    });
                });

                // dock
                dockBtns.forEach((btn) => {
                    const sel = btn.getAttribute("data-ch");
                    const target = sel ? document.querySelector(sel) : null;
                    if (!target) return;
                    btn.addEventListener("click", () => {
                        Sound.clickTick();
                        gsap.to(window, {
                            duration: prefersReducedLocal ? 0 : 0.95,
                            ease: "power3.out",
                            scrollTo: {
                                y: target,
                                offsetY: 88,
                            },
                        });
                    });
                });

                if (chapterBtns[0]) setActiveBtn(chapterBtns[0]);

                // dial (next chapter)
                if (dial && dialProgress) {
                    try {
                        const len = dialProgress.getTotalLength();
                        dialProgress.style.strokeDasharray = String(len);
                        dialProgress.style.strokeDashoffset = String(len);

                        const endEl =
                            document.querySelector("#cta") || document.body;
                        ScrollTrigger.create({
                            trigger: hero,
                            start: "top top",
                            endTrigger: endEl,
                            end: "bottom bottom",
                            onUpdate: (self) => {
                                dialProgress.style.strokeDashoffset = String(
                                    len * (1 - self.progress),
                                );
                                if (dialLabel)
                                    dialLabel.textContent =
                                        self.progress > 0.92 ? "END" : "NEXT";
                            },
                        });

                        const order = [
                            "#about-hero",
                            "#story",
                            "#values",
                            "#timeline",
                            "#team",
                            "#cta",
                        ];
                        dial.addEventListener("click", () => {
                            Sound.clickTick();
                            const activeBtn =
                                chapterBtns.find((b) =>
                                    b.classList.contains("is-active"),
                                ) ||
                                dockBtns.find((b) =>
                                    b.classList.contains("is-active"),
                                );
                            const activeSel =
                                activeBtn?.getAttribute("data-ch") ||
                                "#about-hero";
                            const idx = Math.max(0, order.indexOf(activeSel));
                            const nextSel =
                                order[Math.min(order.length - 1, idx + 1)];
                            const target = document.querySelector(nextSel);
                            if (!target) return;

                            gsap.to(window, {
                                duration: prefersReducedLocal ? 0 : 0.9,
                                ease: "power3.out",
                                scrollTo: {
                                    y: target,
                                    offsetY: 88,
                                },
                            });
                        });
                    } catch {}
                }

                // timeline preview progress
                const tlSec = document.getElementById("timeline");
                const tlProgress = document.getElementById("tlProgress");
                const tlActiveLabel = document.getElementById("tlActiveLabel");
                const items = gsap.utils.toArray(".yex-tl-item");

                function setActiveMilestone(item) {
                    items.forEach((el) =>
                        el.classList.toggle("is-active", el === item),
                    );
                    if (!item) return;
                    const y = item.dataset.year || "";
                    const t = item.dataset.title || "";
                    const label = `${y} • ${t}`.trim();
                    if (tlActiveLabel) tlActiveLabel.textContent = label;
                }

                if (tlSec && tlProgress && items.length) {
                    if (prefersReducedLocal) {
                        gsap.set(tlProgress, {
                            scaleY: 1,
                        });
                        setActiveMilestone(items[0]);
                    } else {
                        gsap.fromTo(
                            tlProgress,
                            {
                                scaleY: 0,
                            },
                            {
                                scaleY: 1,
                                ease: "none",
                                scrollTrigger: {
                                    trigger: tlSec,
                                    start: "top 75%",
                                    end: "bottom 25%",
                                    scrub: true,
                                },
                            },
                        );

                        items.forEach((item, i) => {
                            ScrollTrigger.create({
                                trigger: item,
                                start: "top center",
                                end: "bottom center",
                                onEnter: () => setActiveMilestone(item),
                                onEnterBack: () => setActiveMilestone(item),
                            });
                            if (i === 0) setActiveMilestone(item);
                        });
                    }
                }

                // beliefs spotlight
                gsap.utils.toArray(".yex-spotlight-card").forEach((card) => {
                    card.addEventListener("pointermove", (e) => {
                        const r = card.getBoundingClientRect();
                        const x =
                            ((e.clientX - r.left) / Math.max(1, r.width)) * 100;
                        const y =
                            ((e.clientY - r.top) / Math.max(1, r.height)) * 100;
                        card.style.setProperty("--mx", `${x}%`);
                        card.style.setProperty("--my", `${y}%`);
                    });
                    card.addEventListener("pointerleave", () => {
                        card.style.setProperty("--mx", "50%");
                        card.style.setProperty("--my", "35%");
                    });
                });
            })();

            // -------------------------
            // BLOG PAGE INIT (if #blogStage exists)
            // -------------------------
            const blogGLState =
                window.yexBlogGLState ||
                (window.yexBlogGLState = {
                    instances: [],
                    raf: null,
                    last: 0,
                    resizeBound: false,
                });

            function initBlogGL() {
                const sections = document.querySelectorAll(
                    "[data-blog-gl], [data-portfolio-gl], [data-services-gl], [data-careers-gl], [data-contact-gl]",
                );
                if (!sections.length) return;

                const isLowPower =
                    navigator.hardwareConcurrency &&
                    navigator.hardwareConcurrency <= 4;

                const VERT = `
    attribute vec2 a_pos;
    varying vec2 v_uv;
    void main() {
      v_uv = (a_pos + 1.0) * 0.5;
      gl_Position = vec4(a_pos, 0.0, 1.0);
    }
    `;

                const FRAG = `
    precision mediump float;
    varying vec2 v_uv;
    uniform vec2 u_res;
    uniform float u_time;
    uniform vec3 u_c1;
    uniform vec3 u_c2;
    uniform vec2 u_mouse;
    uniform float u_boost;

    float hash(vec2 p){
      p = fract(p*vec2(123.34, 345.45));
      p += dot(p, p+34.345);
      return fract(p.x*p.y);
    }

    float noise(vec2 p){
      vec2 i = floor(p);
      vec2 f = fract(p);
      float a = hash(i);
      float b = hash(i + vec2(1.0, 0.0));
      float c = hash(i + vec2(0.0, 1.0));
      float d = hash(i + vec2(1.0, 1.0));
      vec2 u = f*f*(3.0-2.0*f);
      return mix(a, b, u.x) + (c-a)*u.y*(1.0-u.x) + (d-b)*u.x*u.y;
    }

    void main(){
      vec2 uv = v_uv;
      vec2 aspect = vec2(u_res.x / max(1.0, u_res.y), 1.0);
      vec2 p = (uv - 0.5) * aspect;
      vec2 mp = (u_mouse - 0.5) * aspect;
      float d = length(p - mp);

      float t = u_time * 0.18;
      uv += 0.02 * sin((uv.yx * 6.0) + t + d * 4.0);

      float n = noise(uv * 4.0 + vec2(t, -t));
      float glow = smoothstep(0.55, 0.0, d);

      vec3 grad = mix(u_c1, u_c2, uv.y + 0.15 * sin(t + uv.x * 3.0));
      grad += 0.10 * vec3(n);
      grad += 0.18 * glow;

      vec3 col = grad * u_boost;
      gl_FragColor = vec4(col, 1.0);
    }
    `;

                function hexToRgb01(hex) {
                    const h = hex.replace("#", "").trim();
                    const full =
                        h.length === 3
                            ? h
                                  .split("")
                                  .map((c) => c + c)
                                  .join("")
                            : h;
                    const n = parseInt(full, 16);
                    return [
                        ((n >> 16) & 255) / 255,
                        ((n >> 8) & 255) / 255,
                        (n & 255) / 255,
                    ];
                }

                function createGL(canvas, c1, c2, boost) {
                    const gl = canvas.getContext("webgl", {
                        antialias: true,
                        alpha: true,
                        premultipliedAlpha: true,
                    });
                    if (!gl) return null;

                    function compile(type, src) {
                        const sh = gl.createShader(type);
                        gl.shaderSource(sh, src);
                        gl.compileShader(sh);
                        if (!gl.getShaderParameter(sh, gl.COMPILE_STATUS)) {
                            console.warn(gl.getShaderInfoLog(sh));
                            gl.deleteShader(sh);
                            return null;
                        }
                        return sh;
                    }

                    const vs = compile(gl.VERTEX_SHADER, VERT);
                    const fs = compile(gl.FRAGMENT_SHADER, FRAG);
                    if (!vs || !fs) return null;

                    const prog = gl.createProgram();
                    gl.attachShader(prog, vs);
                    gl.attachShader(prog, fs);
                    gl.linkProgram(prog);
                    if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
                        console.warn(gl.getProgramInfoLog(prog));
                        return null;
                    }
                    gl.useProgram(prog);

                    const buf = gl.createBuffer();
                    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
                    gl.bufferData(
                        gl.ARRAY_BUFFER,
                        new Float32Array([
                            -1, -1, 1, -1, -1, 1, -1, 1, 1, -1, 1, 1,
                        ]),
                        gl.STATIC_DRAW,
                    );

                    const aPos = gl.getAttribLocation(prog, "a_pos");
                    gl.enableVertexAttribArray(aPos);
                    gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);

                    const uRes = gl.getUniformLocation(prog, "u_res");
                    const uTime = gl.getUniformLocation(prog, "u_time");
                    const uC1 = gl.getUniformLocation(prog, "u_c1");
                    const uC2 = gl.getUniformLocation(prog, "u_c2");
                    const uMouse = gl.getUniformLocation(prog, "u_mouse");
                    const uBoost = gl.getUniformLocation(prog, "u_boost");

                    const rgb1 = hexToRgb01(c1);
                    const rgb2 = hexToRgb01(c2);
                    gl.uniform3f(uC1, rgb1[0], rgb1[1], rgb1[2]);
                    gl.uniform3f(uC2, rgb2[0], rgb2[1], rgb2[2]);
                    gl.uniform1f(uBoost, boost);

                    function resize() {
                        const dpr = Math.min(window.devicePixelRatio || 1, 2);
                        const w = Math.floor(canvas.clientWidth * dpr);
                        const h = Math.floor(canvas.clientHeight * dpr);
                        if (canvas.width !== w || canvas.height !== h) {
                            canvas.width = w;
                            canvas.height = h;
                            gl.viewport(0, 0, w, h);
                            gl.uniform2f(uRes, w, h);
                        }
                    }

                    return {
                        resize,
                        draw: (time, mouse) => {
                            gl.useProgram(prog);
                            gl.uniform1f(uTime, time);
                            gl.uniform2f(uMouse, mouse[0], mouse[1]);
                            gl.drawArrays(gl.TRIANGLES, 0, 6);
                        },
                    };
                }

                sections.forEach((sec) => {
                    const isBlog = sec.hasAttribute("data-blog-gl");
                    const isPortfolio = sec.hasAttribute("data-portfolio-gl");
                    const isServices = sec.hasAttribute("data-services-gl");
                    const isCareers = sec.hasAttribute("data-careers-gl");
                    const isContact = sec.hasAttribute("data-contact-gl");
                    if (isBlog && sec.dataset.blogGlInit === "1") return;
                    if (isPortfolio && sec.dataset.portfolioGlInit === "1")
                        return;
                    if (isServices && sec.dataset.servicesGlInit === "1")
                        return;
                    if (isCareers && sec.dataset.careersGlInit === "1") return;
                    if (isContact && sec.dataset.contactGlInit === "1") return;
                    const canvas = sec.querySelector("canvas.yex-gl");
                    if (!canvas) return;

                    const c1 =
                        sec.dataset.blogGlC1 ||
                        sec.dataset.portfolioGlC1 ||
                        sec.dataset.servicesGlC1 ||
                        sec.dataset.careersGlC1 ||
                        sec.dataset.contactGlC1 ||
                        "#22d3ee";
                    const c2 =
                        sec.dataset.blogGlC2 ||
                        sec.dataset.portfolioGlC2 ||
                        sec.dataset.servicesGlC2 ||
                        sec.dataset.careersGlC2 ||
                        sec.dataset.contactGlC2 ||
                        "#a78bfa";
                    const boost = parseFloat(
                        sec.dataset.blogGlBoost ||
                            sec.dataset.portfolioGlBoost ||
                            sec.dataset.servicesGlBoost ||
                            sec.dataset.careersGlBoost ||
                            sec.dataset.contactGlBoost ||
                            "1.1",
                    );

                    const inst = createGL(canvas, c1, c2, boost);
                    if (!inst) return;

                    if (isBlog) sec.dataset.blogGlInit = "1";
                    if (isPortfolio) sec.dataset.portfolioGlInit = "1";
                    if (isServices) sec.dataset.servicesGlInit = "1";
                    if (isCareers) sec.dataset.careersGlInit = "1";
                    if (isContact) sec.dataset.contactGlInit = "1";
                    const entry = {
                        sec,
                        inst,
                        mouse: [0.5, 0.5],
                        active: true,
                    };

                    const io = new IntersectionObserver(
                        (entries) => {
                            entries.forEach(
                                (e) => (entry.active = e.isIntersecting),
                            );
                        },
                        {
                            threshold: 0.08,
                        },
                    );
                    io.observe(sec);

                    sec.addEventListener("pointermove", (e) => {
                        const r = sec.getBoundingClientRect();
                        const x = (e.clientX - r.left) / Math.max(1, r.width);
                        const y = (e.clientY - r.top) / Math.max(1, r.height);
                        entry.mouse = [x, 1.0 - y];
                    });
                    sec.addEventListener("pointerleave", () => {
                        entry.mouse = [0.5, 0.5];
                    });

                    blogGLState.instances.push(entry);
                });

                if (!blogGLState.instances.length) return;

                if (!blogGLState.resizeBound) {
                    window.addEventListener("resize", () => {
                        blogGLState.instances.forEach(({ inst }) =>
                            inst.resize(),
                        );
                    });
                    blogGLState.resizeBound = true;
                }

                if (blogGLState.raf) return;

                function loop(tms) {
                    const dt = tms - blogGLState.last;
                    const throttle = isLowPower ? 40 : 16;
                    if (dt < throttle) {
                        blogGLState.raf = requestAnimationFrame(loop);
                        return;
                    }
                    blogGLState.last = tms;
                    const t = tms / 1000;

                    blogGLState.instances = blogGLState.instances.filter(
                        (entry) => entry.sec && entry.sec.isConnected,
                    );

                    blogGLState.instances.forEach((entry) => {
                        if (!entry.active) return;
                        entry.inst.resize();
                        entry.inst.draw(t, entry.mouse);
                    });

                    blogGLState.raf = requestAnimationFrame(loop);
                }

                blogGLState.raf = requestAnimationFrame(loop);
            }

            function initBlogs() {
                const stage = document.getElementById("blogStage");
                if (!stage) return;
                if (stage.dataset.yexBlogInit === "1") return;
                stage.dataset.yexBlogInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    stage.querySelectorAll(".blog-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    stage.querySelectorAll(".yex-blog-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    stage.querySelectorAll("[data-blog-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const revealEls = Array.from(
                    document.querySelectorAll("[data-blog-reveal]"),
                );
                revealEls.forEach((el) => {
                    if (el.dataset.blogRevealInit === "1") return;
                    el.dataset.blogRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const meters = Array.from(
                    stage.querySelectorAll("[data-blog-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.blogMeterInit === "1") return;
                    el.dataset.blogMeterInit = "1";

                    const raw = parseFloat(el.dataset.blogMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const marquee = document.querySelector("[data-blog-marquee]");
                if (
                    marquee &&
                    !prefersReducedLocal &&
                    marquee.dataset.blogMarqueeInit !== "1"
                ) {
                    marquee.dataset.blogMarqueeInit = "1";
                    marquee.innerHTML = marquee.innerHTML + marquee.innerHTML;
                    gsap.to(marquee, {
                        xPercent: -50,
                        duration: 18,
                        ease: "none",
                        repeat: -1,
                    });
                }

                const lab = document.getElementById("blogLab");
                if (lab) {
                    const spotlights = Array.from(
                        lab.querySelectorAll(".yex-spotlight-card"),
                    );
                    spotlights.forEach((card) => {
                        if (card.dataset.blogSpotlightInit === "1") return;
                        card.dataset.blogSpotlightInit = "1";

                        card.addEventListener("pointermove", (e) => {
                            const r = card.getBoundingClientRect();
                            const x =
                                ((e.clientX - r.left) / Math.max(1, r.width)) *
                                100;
                            const y =
                                ((e.clientY - r.top) / Math.max(1, r.height)) *
                                100;
                            card.style.setProperty("--mx", `${x}%`);
                            card.style.setProperty("--my", `${y}%`);
                        });
                        card.addEventListener("pointerleave", () => {
                            card.style.setProperty("--mx", "50%");
                            card.style.setProperty("--my", "35%");
                        });
                    });
                }

                const feed = document.getElementById("blogFeed");
                if (feed) {
                    const filterBtns = Array.from(
                        feed.querySelectorAll("[data-blog-filter]"),
                    );
                    const cards = Array.from(
                        feed.querySelectorAll("[data-blog-card]"),
                    );
                    const search = document.getElementById("blogSearch");
                    const countEl = document.getElementById("blogCount");

                    let activeFilter = "all";
                    let query = "";

                    function normalize(s) {
                        return (s || "")
                            .toLowerCase()
                            .replace(/\s+/g, " ")
                            .trim();
                    }

                    function updateFilters() {
                        filterBtns.forEach((btn) => {
                            const on = btn.dataset.blogFilter === activeFilter;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.classList.toggle("text-white", on);
                            btn.classList.toggle("text-white/85", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });
                    }

                    function renderCards() {
                        const tokens = normalize(query)
                            .split(" ")
                            .filter(Boolean);
                        let visible = 0;

                        cards.forEach((card) => {
                            const tags = (card.dataset.blogTags || "")
                                .split(/\s+/)
                                .filter(Boolean);
                            const matchFilter =
                                activeFilter === "all" ||
                                tags.includes(activeFilter);
                            const haystack = normalize(
                                [
                                    card.dataset.blogTitle,
                                    card.dataset.blogDesc,
                                    card.dataset.blogTags,
                                    card.textContent,
                                ].join(" "),
                            );
                            const matchQuery =
                                !tokens.length ||
                                tokens.every((t) => haystack.includes(t));
                            const show = matchFilter && matchQuery;
                            if (show) visible++;

                            const isHidden = card.classList.contains("hidden");
                            if (prefersReducedLocal) {
                                card.classList.toggle("hidden", !show);
                                card.setAttribute(
                                    "aria-hidden",
                                    show ? "false" : "true",
                                );
                                return;
                            }

                            if (show && !isHidden) return;
                            if (!show && isHidden) return;

                            if (show) {
                                card.classList.remove("hidden");
                                card.setAttribute("aria-hidden", "false");
                                gsap.fromTo(
                                    card,
                                    {
                                        opacity: 0,
                                        y: 10,
                                    },
                                    {
                                        opacity: 1,
                                        y: 0,
                                        duration: 0.22,
                                        ease: "power2.out",
                                        clearProps: "opacity,transform",
                                    },
                                );
                            } else {
                                gsap.to(card, {
                                    opacity: 0,
                                    y: 10,
                                    duration: 0.16,
                                    ease: "power2.in",
                                    onComplete: () => {
                                        card.classList.add("hidden");
                                        card.setAttribute(
                                            "aria-hidden",
                                            "true",
                                        );
                                        gsap.set(card, {
                                            opacity: 1,
                                            y: 0,
                                        });
                                    },
                                });
                            }
                        });

                        if (countEl) countEl.textContent = String(visible);
                    }

                    updateFilters();
                    renderCards();

                    filterBtns.forEach((btn) => {
                        btn.addEventListener("click", () => {
                            activeFilter = btn.dataset.blogFilter || "all";
                            updateFilters();
                            renderCards();
                        });
                    });

                    search?.addEventListener("input", (e) => {
                        query = e.target.value || "";
                        renderCards();
                    });
                }
            }

            function initBlogShow() {
                const hero = document.getElementById("blogShowHero");
                if (!hero) return;
                if (hero.dataset.yexBlogShowInit === "1") return;
                hero.dataset.yexBlogShowInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    hero.querySelectorAll(".blog-show-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    hero.querySelectorAll(".yex-blog-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    hero.querySelectorAll("[data-blog-show-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const meters = Array.from(
                    hero.querySelectorAll("[data-blog-show-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.blogShowMeterInit === "1") return;
                    el.dataset.blogShowMeterInit = "1";

                    const raw = parseFloat(el.dataset.blogShowMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const revealEls = Array.from(
                    document.querySelectorAll("[data-blog-show-reveal]"),
                ).filter((el) => !el.classList.contains("yex-card"));
                revealEls.forEach((el) => {
                    if (el.dataset.blogShowRevealInit === "1") return;
                    el.dataset.blogShowRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const article = document.getElementById("blogArticle");
                const progressBar = document.getElementById("blogReadProgress");
                const progressMini = document.getElementById(
                    "blogReadProgressMini",
                );
                const percentEl = document.getElementById("blogReadPercent");
                const percentAside = document.getElementById(
                    "blogReadPercentAside",
                );

                if (
                    article &&
                    (progressBar || progressMini || percentEl || percentAside)
                ) {
                    ScrollTrigger.create({
                        trigger: article,
                        start: "top top",
                        end: "bottom bottom",
                        onUpdate: (self) => {
                            const pct = Math.round(self.progress * 100);
                            if (progressBar)
                                progressBar.style.width = `${pct}%`;
                            if (progressMini)
                                progressMini.style.width = `${pct}%`;
                            if (percentEl) percentEl.textContent = `${pct}%`;
                            if (percentAside)
                                percentAside.textContent = `${pct}%`;
                        },
                    });
                }

                const toc = document.getElementById("blogToc");
                const indicator = document.getElementById("blogTocIndicator");
                const activeLabel =
                    document.getElementById("blogActiveSection");
                const tocLinks = Array.from(
                    document.querySelectorAll("[data-blog-toc]"),
                );
                const sections = Array.from(
                    document.querySelectorAll("[data-blog-section]"),
                );

                function moveIndicator(link) {
                    if (!indicator || !toc || !link) return;
                    const navRect = toc.getBoundingClientRect();
                    const linkRect = link.getBoundingClientRect();
                    const y = linkRect.top - navRect.top;
                    const h = linkRect.height;

                    if (prefersReducedLocal) {
                        indicator.style.opacity = "1";
                        indicator.style.transform = `translateY(${y}px)`;
                        indicator.style.height = `${h}px`;
                        return;
                    }

                    gsap.to(indicator, {
                        opacity: 1,
                        duration: 0.2,
                        ease: "power2.out",
                    });
                    gsap.to(indicator, {
                        y,
                        height: h,
                        duration: 0.25,
                        ease: "power3.out",
                    });
                }

                function setActiveSection(section) {
                    if (!section) return;
                    const id = section.id;
                    const activeLink = tocLinks.find(
                        (link) => link.getAttribute("href") === `#${id}`,
                    );

                    tocLinks.forEach((link) => {
                        const on = link === activeLink;
                        link.classList.toggle("bg-white/10", on);
                        link.classList.toggle("text-white", on);
                        link.classList.toggle("text-white/70", !on);
                        link.setAttribute(
                            "aria-current",
                            on ? "true" : "false",
                        );
                    });

                    const label =
                        section.dataset.blogTitle ||
                        section.querySelector("h2")?.textContent ||
                        "Section";
                    if (activeLabel) activeLabel.textContent = label;
                    moveIndicator(activeLink);
                }

                sections.forEach((section) => {
                    ScrollTrigger.create({
                        trigger: section,
                        start: "top center",
                        end: "bottom center",
                        onEnter: () => setActiveSection(section),
                        onEnterBack: () => setActiveSection(section),
                    });
                });

                if (sections[0]) setActiveSection(sections[0]);

                const spotlights = Array.from(
                    document.querySelectorAll(
                        "#blogShowLab .yex-spotlight-card, #blogArticle .yex-spotlight-card",
                    ),
                );
                spotlights.forEach((card) => {
                    if (card.dataset.blogShowSpotlightInit === "1") return;
                    card.dataset.blogShowSpotlightInit = "1";

                    card.addEventListener("pointermove", (e) => {
                        const r = card.getBoundingClientRect();
                        const x =
                            ((e.clientX - r.left) / Math.max(1, r.width)) * 100;
                        const y =
                            ((e.clientY - r.top) / Math.max(1, r.height)) * 100;
                        card.style.setProperty("--mx", `${x}%`);
                        card.style.setProperty("--my", `${y}%`);
                    });
                    card.addEventListener("pointerleave", () => {
                        card.style.setProperty("--mx", "50%");
                        card.style.setProperty("--my", "35%");
                    });
                });
            }

            function initPortfolio() {
                const hero = document.getElementById("portfolioHero");
                if (!hero) return;
                if (hero.dataset.yexPortfolioInit === "1") return;
                hero.dataset.yexPortfolioInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    hero.querySelectorAll(".portfolio-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    hero.querySelectorAll(".yex-portfolio-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    hero.querySelectorAll("[data-portfolio-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const meters = Array.from(
                    hero.querySelectorAll("[data-portfolio-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.portfolioMeterInit === "1") return;
                    el.dataset.portfolioMeterInit = "1";

                    const raw = parseFloat(el.dataset.portfolioMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const revealEls = Array.from(
                    document.querySelectorAll("[data-portfolio-reveal]"),
                ).filter((el) => !el.classList.contains("yex-card"));
                revealEls.forEach((el) => {
                    if (el.dataset.portfolioRevealInit === "1") return;
                    el.dataset.portfolioRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const marquee = document.querySelector(
                    "[data-portfolio-marquee]",
                );
                if (
                    marquee &&
                    !prefersReducedLocal &&
                    marquee.dataset.portfolioMarqueeInit !== "1"
                ) {
                    marquee.dataset.portfolioMarqueeInit = "1";
                    marquee.innerHTML = marquee.innerHTML + marquee.innerHTML;
                    gsap.to(marquee, {
                        xPercent: -50,
                        duration: 18,
                        ease: "none",
                        repeat: -1,
                    });
                }

                const showcase = document.getElementById("portfolioShowcase");
                if (showcase) {
                    const previewPanel = document.getElementById(
                        "portfolioPreviewPanel",
                    );
                    const previewGlow = document.getElementById(
                        "portfolioPreviewGlow",
                    );
                    const previewTitle = document.getElementById(
                        "portfolioPreviewTitle",
                    );
                    const previewSub = document.getElementById(
                        "portfolioPreviewSub",
                    );
                    const previewTags = document.getElementById(
                        "portfolioPreviewTags",
                    );
                    const previewImpact = document.getElementById(
                        "portfolioPreviewImpact",
                    );
                    const previewStack = document.getElementById(
                        "portfolioPreviewStack",
                    );
                    const previewItems = Array.from(
                        showcase.querySelectorAll("[data-portfolio-item]"),
                    );

                    function hexToRgb(hex) {
                        const h = hex.replace("#", "").trim();
                        const full =
                            h.length === 3
                                ? h
                                      .split("")
                                      .map((c) => c + c)
                                      .join("")
                                : h;
                        const n = parseInt(full, 16);
                        return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
                    }

                    function setPreview(item) {
                        if (!item) return;

                        previewItems.forEach((btn) => {
                            const on = btn === item;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });

                        const title =
                            item.dataset.portfolioTitle ||
                            item.textContent.trim();
                        const sub = item.dataset.portfolioSub || "";
                        const impact =
                            item.dataset.portfolioImpact || "Measured impact";
                        const stack = item.dataset.portfolioStack || "Stack";
                        const tagsRaw = item.dataset.portfolioTags || "";
                        const tags = tagsRaw
                            .split(",")
                            .map((t) => t.trim())
                            .filter(Boolean);

                        if (previewTitle) previewTitle.textContent = title;
                        if (previewSub) previewSub.textContent = sub;
                        if (previewImpact) previewImpact.textContent = impact;
                        if (previewStack) previewStack.textContent = stack;

                        if (previewTags) {
                            previewTags.innerHTML = "";
                            tags.forEach((tag) => {
                                const chip = document.createElement("span");
                                chip.className =
                                    "rounded-full bg-white/5 px-3 py-1 text-xs text-white/70 ring-1 ring-white/10";
                                chip.textContent = tag;
                                previewTags.appendChild(chip);
                            });
                        }

                        const c1 = item.dataset.portfolioC1 || "#22d3ee";
                        const c2 = item.dataset.portfolioC2 || "#7c3aed";
                        if (previewGlow) {
                            const rgb1 = hexToRgb(c1);
                            const rgb2 = hexToRgb(c2);
                            previewGlow.style.background = `radial-gradient(600px circle at 20% 20%, rgba(${rgb1[0]}, ${rgb1[1]}, ${rgb1[2]}, 0.35), transparent 60%), radial-gradient(650px circle at 80% 80%, rgba(${rgb2[0]}, ${rgb2[1]}, ${rgb2[2]}, 0.28), transparent 60%)`;
                            if (!prefersReducedLocal) {
                                gsap.fromTo(
                                    previewGlow,
                                    {
                                        opacity: 0.45,
                                    },
                                    {
                                        opacity: 0.9,
                                        duration: 0.35,
                                        ease: "power2.out",
                                    },
                                );
                            }
                        }

                        if (!prefersReducedLocal && previewPanel) {
                            gsap.fromTo(
                                previewPanel,
                                {
                                    y: 6,
                                    opacity: 0.95,
                                },
                                {
                                    y: 0,
                                    opacity: 1,
                                    duration: 0.25,
                                    ease: "power2.out",
                                },
                            );
                        }
                    }

                    if (previewItems.length) {
                        previewItems.forEach((item) => {
                            item.addEventListener("pointerenter", () =>
                                setPreview(item),
                            );
                            item.addEventListener("click", () =>
                                setPreview(item),
                            );
                        });
                        setPreview(previewItems[0]);
                    }
                }

                const feed = document.getElementById("portfolioFeed");
                if (feed) {
                    const filterBtns = Array.from(
                        feed.querySelectorAll("[data-portfolio-filter]"),
                    );
                    const cards = Array.from(
                        feed.querySelectorAll("[data-portfolio-card]"),
                    );
                    const search = document.getElementById("portfolioSearch");
                    const countEl = document.getElementById("portfolioCount");

                    let activeFilter = "all";
                    let query = "";

                    function normalize(s) {
                        return (s || "")
                            .toLowerCase()
                            .replace(/\s+/g, " ")
                            .trim();
                    }

                    function updateFilters() {
                        filterBtns.forEach((btn) => {
                            const on =
                                btn.dataset.portfolioFilter === activeFilter;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.classList.toggle("text-white", on);
                            btn.classList.toggle("text-white/85", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });
                    }

                    function renderCards() {
                        const tokens = normalize(query)
                            .split(" ")
                            .filter(Boolean);
                        let visible = 0;

                        cards.forEach((card) => {
                            const tags = (card.dataset.portfolioTags || "")
                                .split(/\s+/)
                                .filter(Boolean);
                            const matchFilter =
                                activeFilter === "all" ||
                                tags.includes(activeFilter);
                            const haystack = normalize(
                                [
                                    card.dataset.portfolioTitle,
                                    card.dataset.portfolioDesc,
                                    card.dataset.portfolioTags,
                                    card.textContent,
                                ].join(" "),
                            );
                            const matchQuery =
                                !tokens.length ||
                                tokens.every((t) => haystack.includes(t));
                            const show = matchFilter && matchQuery;
                            if (show) visible++;

                            const isHidden = card.classList.contains("hidden");
                            if (prefersReducedLocal) {
                                card.classList.toggle("hidden", !show);
                                card.setAttribute(
                                    "aria-hidden",
                                    show ? "false" : "true",
                                );
                                return;
                            }

                            if (show && !isHidden) return;
                            if (!show && isHidden) return;

                            if (show) {
                                card.classList.remove("hidden");
                                card.setAttribute("aria-hidden", "false");
                                gsap.fromTo(
                                    card,
                                    {
                                        opacity: 0,
                                        y: 10,
                                    },
                                    {
                                        opacity: 1,
                                        y: 0,
                                        duration: 0.22,
                                        ease: "power2.out",
                                        clearProps: "opacity,transform",
                                    },
                                );
                            } else {
                                gsap.to(card, {
                                    opacity: 0,
                                    y: 10,
                                    duration: 0.16,
                                    ease: "power2.in",
                                    onComplete: () => {
                                        card.classList.add("hidden");
                                        card.setAttribute(
                                            "aria-hidden",
                                            "true",
                                        );
                                        gsap.set(card, {
                                            opacity: 1,
                                            y: 0,
                                        });
                                    },
                                });
                            }
                        });

                        if (countEl) countEl.textContent = String(visible);
                    }

                    updateFilters();
                    renderCards();

                    filterBtns.forEach((btn) => {
                        btn.addEventListener("click", () => {
                            activeFilter = btn.dataset.portfolioFilter || "all";
                            updateFilters();
                            renderCards();
                        });
                    });

                    search?.addEventListener("input", (e) => {
                        query = e.target.value || "";
                        renderCards();
                    });
                }
            }

            function initServices() {
                const hero = document.getElementById("servicesHero");
                if (!hero) return;
                if (hero.dataset.yexServicesInit === "1") return;
                hero.dataset.yexServicesInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    hero.querySelectorAll(".services-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    hero.querySelectorAll(".yex-services-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    hero.querySelectorAll("[data-services-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const meters = Array.from(
                    hero.querySelectorAll("[data-services-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.servicesMeterInit === "1") return;
                    el.dataset.servicesMeterInit = "1";

                    const raw = parseFloat(el.dataset.servicesMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const revealEls = Array.from(
                    document.querySelectorAll("[data-services-reveal]"),
                ).filter((el) => !el.classList.contains("yex-card"));
                revealEls.forEach((el) => {
                    if (el.dataset.servicesRevealInit === "1") return;
                    el.dataset.servicesRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const marquee = document.querySelector(
                    "[data-services-marquee]",
                );
                if (
                    marquee &&
                    !prefersReducedLocal &&
                    marquee.dataset.servicesMarqueeInit !== "1"
                ) {
                    marquee.dataset.servicesMarqueeInit = "1";
                    marquee.innerHTML = marquee.innerHTML + marquee.innerHTML;
                    gsap.to(marquee, {
                        xPercent: -50,
                        duration: 18,
                        ease: "none",
                        repeat: -1,
                    });
                }

                const showcase = document.getElementById("servicesShowcase");
                if (showcase) {
                    const previewPanel = document.getElementById(
                        "servicesPreviewPanel",
                    );
                    const previewGlow = document.getElementById(
                        "servicesPreviewGlow",
                    );
                    const previewTitle = document.getElementById(
                        "servicesPreviewTitle",
                    );
                    const previewSub =
                        document.getElementById("servicesPreviewSub");
                    const previewTags = document.getElementById(
                        "servicesPreviewTags",
                    );
                    const previewImpact = document.getElementById(
                        "servicesPreviewImpact",
                    );
                    const previewStack = document.getElementById(
                        "servicesPreviewStack",
                    );
                    const previewItems = Array.from(
                        showcase.querySelectorAll("[data-services-item]"),
                    );

                    function hexToRgb(hex) {
                        const h = hex.replace("#", "").trim();
                        const full =
                            h.length === 3
                                ? h
                                      .split("")
                                      .map((c) => c + c)
                                      .join("")
                                : h;
                        const n = parseInt(full, 16);
                        return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
                    }

                    function setPreview(item) {
                        if (!item) return;

                        previewItems.forEach((btn) => {
                            const on = btn === item;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });

                        const title =
                            item.dataset.servicesTitle ||
                            item.textContent.trim();
                        const sub = item.dataset.servicesSub || "";
                        const impact =
                            item.dataset.servicesImpact || "Measured impact";
                        const stack = item.dataset.servicesStack || "Tooling";
                        const tagsRaw = item.dataset.servicesTags || "";
                        const tags = tagsRaw
                            .split(",")
                            .map((t) => t.trim())
                            .filter(Boolean);

                        if (previewTitle) previewTitle.textContent = title;
                        if (previewSub) previewSub.textContent = sub;
                        if (previewImpact) previewImpact.textContent = impact;
                        if (previewStack) previewStack.textContent = stack;

                        if (previewTags) {
                            previewTags.innerHTML = "";
                            tags.forEach((tag) => {
                                const chip = document.createElement("span");
                                chip.className =
                                    "rounded-full bg-white/5 px-3 py-1 text-xs text-white/70 ring-1 ring-white/10";
                                chip.textContent = tag;
                                previewTags.appendChild(chip);
                            });
                        }

                        const c1 = item.dataset.servicesC1 || "#22d3ee";
                        const c2 = item.dataset.servicesC2 || "#fb7185";
                        if (previewGlow) {
                            const rgb1 = hexToRgb(c1);
                            const rgb2 = hexToRgb(c2);
                            previewGlow.style.background = `radial-gradient(600px circle at 20% 20%, rgba(${rgb1[0]}, ${rgb1[1]}, ${rgb1[2]}, 0.35), transparent 60%), radial-gradient(650px circle at 80% 80%, rgba(${rgb2[0]}, ${rgb2[1]}, ${rgb2[2]}, 0.28), transparent 60%)`;
                            if (!prefersReducedLocal) {
                                gsap.fromTo(
                                    previewGlow,
                                    {
                                        opacity: 0.45,
                                    },
                                    {
                                        opacity: 0.9,
                                        duration: 0.35,
                                        ease: "power2.out",
                                    },
                                );
                            }
                        }

                        if (!prefersReducedLocal && previewPanel) {
                            gsap.fromTo(
                                previewPanel,
                                {
                                    y: 6,
                                    opacity: 0.95,
                                },
                                {
                                    y: 0,
                                    opacity: 1,
                                    duration: 0.25,
                                    ease: "power2.out",
                                },
                            );
                        }
                    }

                    if (previewItems.length) {
                        previewItems.forEach((item) => {
                            item.addEventListener("pointerenter", () =>
                                setPreview(item),
                            );
                            item.addEventListener("click", () =>
                                setPreview(item),
                            );
                        });
                        setPreview(previewItems[0]);
                    }
                }
            }

            function initCareers() {
                const hero = document.getElementById("careersHero");
                if (!hero) return;
                if (hero.dataset.yexCareersInit === "1") return;
                hero.dataset.yexCareersInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    hero.querySelectorAll(".careers-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    hero.querySelectorAll(".yex-careers-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    hero.querySelectorAll("[data-careers-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const meters = Array.from(
                    hero.querySelectorAll("[data-careers-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.careersMeterInit === "1") return;
                    el.dataset.careersMeterInit = "1";

                    const raw = parseFloat(el.dataset.careersMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const revealEls = Array.from(
                    document.querySelectorAll("[data-careers-reveal]"),
                ).filter((el) => !el.classList.contains("yex-card"));
                revealEls.forEach((el) => {
                    if (el.dataset.careersRevealInit === "1") return;
                    el.dataset.careersRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const marquee = document.querySelector(
                    "[data-careers-marquee]",
                );
                if (
                    marquee &&
                    !prefersReducedLocal &&
                    marquee.dataset.careersMarqueeInit !== "1"
                ) {
                    marquee.dataset.careersMarqueeInit = "1";
                    marquee.innerHTML = marquee.innerHTML + marquee.innerHTML;
                    gsap.to(marquee, {
                        xPercent: -50,
                        duration: 18,
                        ease: "none",
                        repeat: -1,
                    });
                }

                const showcase = document.getElementById("careersShowcase");
                if (showcase) {
                    const previewPanel = document.getElementById(
                        "careersPreviewPanel",
                    );
                    const previewGlow =
                        document.getElementById("careersPreviewGlow");
                    const previewTitle = document.getElementById(
                        "careersPreviewTitle",
                    );
                    const previewSub =
                        document.getElementById("careersPreviewSub");
                    const previewTags =
                        document.getElementById("careersPreviewTags");
                    const previewImpact = document.getElementById(
                        "careersPreviewImpact",
                    );
                    const previewStack = document.getElementById(
                        "careersPreviewStack",
                    );
                    const previewItems = Array.from(
                        showcase.querySelectorAll("[data-careers-item]"),
                    );

                    function hexToRgb(hex) {
                        const h = hex.replace("#", "").trim();
                        const full =
                            h.length === 3
                                ? h
                                      .split("")
                                      .map((c) => c + c)
                                      .join("")
                                : h;
                        const n = parseInt(full, 16);
                        return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
                    }

                    function setPreview(item) {
                        if (!item) return;

                        previewItems.forEach((btn) => {
                            const on = btn === item;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });

                        const title =
                            item.dataset.careersTitle ||
                            item.textContent.trim();
                        const sub = item.dataset.careersSub || "";
                        const impact = item.dataset.careersImpact || "Impact";
                        const stack = item.dataset.careersStack || "Focus";
                        const tagsRaw = item.dataset.careersTags || "";
                        const tags = tagsRaw
                            .split(",")
                            .map((t) => t.trim())
                            .filter(Boolean);

                        if (previewTitle) previewTitle.textContent = title;
                        if (previewSub) previewSub.textContent = sub;
                        if (previewImpact) previewImpact.textContent = impact;
                        if (previewStack) previewStack.textContent = stack;

                        if (previewTags) {
                            previewTags.innerHTML = "";
                            tags.forEach((tag) => {
                                const chip = document.createElement("span");
                                chip.className =
                                    "rounded-full bg-white/5 px-3 py-1 text-xs text-white/70 ring-1 ring-white/10";
                                chip.textContent = tag;
                                previewTags.appendChild(chip);
                            });
                        }

                        const c1 = item.dataset.careersC1 || "#22d3ee";
                        const c2 = item.dataset.careersC2 || "#f97316";
                        if (previewGlow) {
                            const rgb1 = hexToRgb(c1);
                            const rgb2 = hexToRgb(c2);
                            previewGlow.style.background = `radial-gradient(600px circle at 20% 20%, rgba(${rgb1[0]}, ${rgb1[1]}, ${rgb1[2]}, 0.35), transparent 60%), radial-gradient(650px circle at 80% 80%, rgba(${rgb2[0]}, ${rgb2[1]}, ${rgb2[2]}, 0.28), transparent 60%)`;
                            if (!prefersReducedLocal) {
                                gsap.fromTo(
                                    previewGlow,
                                    {
                                        opacity: 0.45,
                                    },
                                    {
                                        opacity: 0.9,
                                        duration: 0.35,
                                        ease: "power2.out",
                                    },
                                );
                            }
                        }

                        if (!prefersReducedLocal && previewPanel) {
                            gsap.fromTo(
                                previewPanel,
                                {
                                    y: 6,
                                    opacity: 0.95,
                                },
                                {
                                    y: 0,
                                    opacity: 1,
                                    duration: 0.25,
                                    ease: "power2.out",
                                },
                            );
                        }
                    }

                    if (previewItems.length) {
                        previewItems.forEach((item) => {
                            item.addEventListener("pointerenter", () =>
                                setPreview(item),
                            );
                            item.addEventListener("click", () =>
                                setPreview(item),
                            );
                        });
                        setPreview(previewItems[0]);
                    }
                }

                const openSection = document.getElementById("careersOpen");
                if (openSection) {
                    const countEl = document.getElementById("careersCount");
                    const cards = Array.from(
                        openSection.querySelectorAll("[data-careers-card]"),
                    );
                    if (countEl) countEl.textContent = String(cards.length);
                }
            }

            function initContact() {
                const hero = document.getElementById("contactHero");
                if (!hero) return;
                if (hero.dataset.yexContactInit === "1") return;
                hero.dataset.yexContactInit = "1";

                const prefersReducedLocal = prefersReduced;

                initBlogGL();

                const heroLines = Array.from(
                    hero.querySelectorAll(".contact-hero-line"),
                );
                if (heroLines.length && !prefersReducedLocal) {
                    gsap.set(heroLines, {
                        opacity: 0,
                        y: 14,
                        filter: "blur(6px)",
                    });
                    gsap.to(heroLines, {
                        opacity: 1,
                        y: 0,
                        filter: "blur(0px)",
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.12,
                        clearProps: "filter",
                    });
                }

                const floaters = Array.from(
                    hero.querySelectorAll(".yex-contact-float"),
                );
                if (!prefersReducedLocal) {
                    floaters.forEach((el, i) => {
                        gsap.to(el, {
                            y: -6,
                            duration: 2.2 + i * 0.2,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                        });
                    });
                }

                const pulses = Array.from(
                    hero.querySelectorAll("[data-contact-pulse]"),
                );
                if (!prefersReducedLocal) {
                    pulses.forEach((el, i) => {
                        gsap.to(el, {
                            scale: 1.35,
                            opacity: 0.55,
                            duration: 1.4,
                            repeat: -1,
                            yoyo: true,
                            ease: "sine.inOut",
                            delay: i * 0.2,
                        });
                    });
                }

                const meters = Array.from(
                    hero.querySelectorAll("[data-contact-meter]"),
                );
                meters.forEach((el, i) => {
                    if (el.dataset.contactMeterInit === "1") return;
                    el.dataset.contactMeterInit = "1";

                    const raw = parseFloat(el.dataset.contactMeter || "0");
                    const val = Math.max(0, Math.min(1, raw));
                    const pct = Math.round(val * 100);

                    if (prefersReducedLocal) {
                        el.style.width = `${pct}%`;
                        return;
                    }

                    gsap.fromTo(
                        el,
                        {
                            width: "0%",
                        },
                        {
                            width: `${pct}%`,
                            duration: 0.9,
                            ease: "power3.out",
                            delay: 0.1 + i * 0.08,
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                                once: true,
                            },
                        },
                    );
                });

                const revealEls = Array.from(
                    document.querySelectorAll("[data-contact-reveal]"),
                );
                revealEls.forEach((el) => {
                    if (el.dataset.contactRevealInit === "1") return;
                    el.dataset.contactRevealInit = "1";

                    gsap.fromTo(
                        el,
                        {
                            y: prefersReducedLocal ? 0 : 18,
                            opacity: 0,
                        },
                        {
                            y: 0,
                            opacity: 1,
                            duration: prefersReducedLocal ? 0 : 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: el,
                                start: "top 85%",
                            },
                        },
                    );
                });

                const marquee = document.querySelector(
                    "[data-contact-marquee]",
                );
                if (
                    marquee &&
                    !prefersReducedLocal &&
                    marquee.dataset.contactMarqueeInit !== "1"
                ) {
                    marquee.dataset.contactMarqueeInit = "1";
                    marquee.innerHTML = marquee.innerHTML + marquee.innerHTML;
                    gsap.to(marquee, {
                        xPercent: -50,
                        duration: 18,
                        ease: "none",
                        repeat: -1,
                    });
                }

                const showcase = document.getElementById("contactShowcase");
                if (showcase) {
                    const previewPanel = document.getElementById(
                        "contactPreviewPanel",
                    );
                    const previewGlow =
                        document.getElementById("contactPreviewGlow");
                    const previewTitle = document.getElementById(
                        "contactPreviewTitle",
                    );
                    const previewSub =
                        document.getElementById("contactPreviewSub");
                    const previewTags =
                        document.getElementById("contactPreviewTags");
                    const previewImpact = document.getElementById(
                        "contactPreviewImpact",
                    );
                    const previewStack = document.getElementById(
                        "contactPreviewStack",
                    );
                    const previewItems = Array.from(
                        showcase.querySelectorAll("[data-contact-item]"),
                    );

                    function hexToRgb(hex) {
                        const h = hex.replace("#", "").trim();
                        const full =
                            h.length === 3
                                ? h
                                      .split("")
                                      .map((c) => c + c)
                                      .join("")
                                : h;
                        const n = parseInt(full, 16);
                        return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
                    }

                    function setPreview(item) {
                        if (!item) return;

                        previewItems.forEach((btn) => {
                            const on = btn === item;
                            btn.classList.toggle("bg-white/10", on);
                            btn.classList.toggle("bg-white/5", !on);
                            btn.setAttribute(
                                "aria-pressed",
                                on ? "true" : "false",
                            );
                        });

                        const title =
                            item.dataset.contactTitle ||
                            item.textContent.trim();
                        const sub = item.dataset.contactSub || "";
                        const impact =
                            item.dataset.contactImpact || "Response window";
                        const stack = item.dataset.contactStack || "Flow";
                        const tagsRaw = item.dataset.contactTags || "";
                        const tags = tagsRaw
                            .split(",")
                            .map((t) => t.trim())
                            .filter(Boolean);

                        if (previewTitle) previewTitle.textContent = title;
                        if (previewSub) previewSub.textContent = sub;
                        if (previewImpact) previewImpact.textContent = impact;
                        if (previewStack) previewStack.textContent = stack;

                        if (previewTags) {
                            previewTags.innerHTML = "";
                            tags.forEach((tag) => {
                                const chip = document.createElement("span");
                                chip.className =
                                    "rounded-full bg-white/5 px-3 py-1 text-xs text-white/70 ring-1 ring-white/10";
                                chip.textContent = tag;
                                previewTags.appendChild(chip);
                            });
                        }

                        const c1 = item.dataset.contactC1 || "#22d3ee";
                        const c2 = item.dataset.contactC2 || "#7c3aed";
                        if (previewGlow) {
                            const rgb1 = hexToRgb(c1);
                            const rgb2 = hexToRgb(c2);
                            previewGlow.style.background = `radial-gradient(600px circle at 20% 20%, rgba(${rgb1[0]}, ${rgb1[1]}, ${rgb1[2]}, 0.35), transparent 60%), radial-gradient(650px circle at 80% 80%, rgba(${rgb2[0]}, ${rgb2[1]}, ${rgb2[2]}, 0.28), transparent 60%)`;
                            if (!prefersReducedLocal) {
                                gsap.fromTo(
                                    previewGlow,
                                    {
                                        opacity: 0.45,
                                    },
                                    {
                                        opacity: 0.9,
                                        duration: 0.35,
                                        ease: "power2.out",
                                    },
                                );
                            }
                        }

                        if (!prefersReducedLocal && previewPanel) {
                            gsap.fromTo(
                                previewPanel,
                                {
                                    y: 6,
                                    opacity: 0.95,
                                },
                                {
                                    y: 0,
                                    opacity: 1,
                                    duration: 0.25,
                                    ease: "power2.out",
                                },
                            );
                        }
                    }

                    if (previewItems.length) {
                        previewItems.forEach((item) => {
                            item.addEventListener("pointerenter", () =>
                                setPreview(item),
                            );
                            item.addEventListener("click", () =>
                                setPreview(item),
                            );
                        });
                        setPreview(previewItems[0]);
                    }
                }
            }

            initBlogs();
            initBlogShow();
            initPortfolio();
            initServices();
            initCareers();
            initContact();
            document.addEventListener("livewire:navigated", initBlogs);
            document.addEventListener("livewire:navigated", initBlogShow);
            document.addEventListener("livewire:navigated", initPortfolio);
            document.addEventListener("livewire:navigated", initServices);
            document.addEventListener("livewire:navigated", initCareers);
            document.addEventListener("livewire:navigated", initContact);

            // -------------------------
            // HISTORY PAGE INIT (if #historyStage exists)
            // -------------------------
            function initHistory() {
                const stage = document.getElementById("historyStage");
                if (!stage) return;
                if (stage.dataset.yexHistoryInit === "1") return;
                stage.dataset.yexHistoryInit = "1";

                const rail = document.getElementById("historyRail");
                const track = document.getElementById("historyTrack");
                const items = track
                    ? Array.from(track.querySelectorAll(".yex-h-item"))
                    : [];

                const titleEl = document.getElementById("historyTitle");
                const subEl = document.getElementById("historySub");
                const yearEl = document.getElementById("historyYear");
                const activeLabelEl =
                    document.getElementById("historyActiveLabel");
                const hint = document.getElementById("historyHint");

                const soundBtn = document.getElementById("historySoundToggle");

                const detail = document.getElementById("historyDetail");
                const detailBackdrop = detail
                    ? detail.querySelector(".yex-history-detail__backdrop")
                    : null;
                const detailPanel = detail
                    ? detail.querySelector(".yex-history-detail__panel")
                    : null;
                const detailClose = document.getElementById("historyClose");
                const detailMeta = document.getElementById("historyDetailMeta");
                const detailTitle =
                    document.getElementById("historyDetailTitle");
                const runText = document.getElementById("historyRunText");

                if (!rail || !track || !items.length) return;

                function syncHistorySoundLabel() {
                    if (!soundBtn) return;
                    soundBtn.textContent = Sound.isEnabled()
                        ? "Sound: On"
                        : "Sound: Off";
                }
                syncHistorySoundLabel();

                soundBtn?.addEventListener("click", () => {
                    Sound.setEnabled(!Sound.isEnabled());
                    syncHistorySoundLabel();
                    Sound.clickTick();
                });

                const clamp = (v, a, b) => Math.min(b, Math.max(a, v));

                let bounds = {
                    minX: 0,
                    maxX: 0,
                };

                function calcBounds() {
                    const railW = rail.clientWidth;
                    const trackW = track.scrollWidth;
                    const minX = Math.min(0, railW - trackW);
                    bounds = {
                        minX,
                        maxX: 0,
                    };
                    return bounds;
                }

                let x = 0;
                const setX = gsap.quickSetter(track, "x", "px");

                function applyX(v) {
                    x = clamp(v, bounds.minX, bounds.maxX);
                    setX(x);
                }

                function centerOnItem(item, animate = true) {
                    calcBounds();
                    const railCenter = rail.clientWidth / 2;
                    const itemCenter = item.offsetLeft + item.offsetWidth / 2;
                    const targetX = railCenter - itemCenter;

                    if (!animate || prefersReducedLocal) {
                        applyX(targetX);
                    } else {
                        gsap.to(track, {
                            x: clamp(targetX, bounds.minX, bounds.maxX),
                            duration: 0.65,
                            ease: "power3.out",
                            onUpdate: () => {
                                x = gsap.getProperty(track, "x");
                            },
                        });
                    }
                }

                let activeItem = null;
                let lastActiveKey = "";

                function setActive(
                    item,
                    opts = {
                        snap: false,
                        announce: true,
                    },
                ) {
                    if (!item) return;
                    activeItem = item;
                    items.forEach((it) =>
                        it.classList.toggle("is-active", it === item),
                    );

                    const year = item.dataset.year || "";
                    const ttl = item.dataset.title || "";
                    const label = `${year} • ${ttl}`.trim();

                    if (activeLabelEl) activeLabelEl.textContent = label;
                    if (yearEl) yearEl.textContent = year;
                    if (titleEl) titleEl.textContent = ttl || "—";
                    if (subEl)
                        subEl.textContent =
                            "Drag to navigate the timeline. Click a node to read details.";

                    if (opts && opts.snap) centerOnItem(item, true);

                    if (
                        opts &&
                        opts.announce &&
                        label &&
                        label !== lastActiveKey
                    ) {
                        lastActiveKey = label;

                        if (!prefersReducedLocal) {
                            gsap.fromTo(
                                [titleEl, yearEl],
                                {
                                    opacity: 0.35,
                                    y: 8,
                                    filter: "blur(6px)",
                                },
                                {
                                    opacity: 1,
                                    y: 0,
                                    filter: "blur(0px)",
                                    duration: 0.28,
                                    ease: "power2.out",
                                    clearProps: "filter",
                                },
                            );
                        }
                        Sound.hoverTick();
                    }
                }

                function pickActiveFromX() {
                    const railCenter = -x + rail.clientWidth / 2;
                    let best = items[0];
                    let bestD = Infinity;

                    for (const it of items) {
                        const c = it.offsetLeft + it.offsetWidth / 2;
                        const d = Math.abs(c - railCenter);
                        if (d < bestD) {
                            bestD = d;
                            best = it;
                        }
                    }
                    if (best && best !== activeItem)
                        setActive(best, {
                            snap: false,
                            announce: true,
                        });
                }

                // init
                calcBounds();
                applyX(0);
                setActive(items[0], {
                    snap: false,
                    announce: false,
                });
                centerOnItem(items[0], false);

                // drag
                let dragging = false;
                let moved = false;
                let startPX = 0;
                let startX = 0;
                let lastPX = 0;
                let lastT = 0;
                let vel = 0;
                let pressItem = null;

                function hideHint() {
                    if (!hint) return;
                    if (prefersReducedLocal) {
                        hint.style.display = "none";
                        return;
                    }
                    gsap.to(hint, {
                        opacity: 0,
                        y: 10,
                        duration: 0.28,
                        ease: "power2.out",
                        onComplete: () => hint.remove(),
                    });
                }

                rail.addEventListener("pointerdown", (e) => {
                    dragging = true;
                    moved = false;
                    pressItem = e.target.closest(".yex-h-item");
                    startPX = e.clientX;
                    startX = x;
                    lastPX = e.clientX;
                    lastT = performance.now();
                    vel = 0;

                    rail.classList.add("is-dragging");
                    rail.setPointerCapture(e.pointerId);
                    hideHint();
                });

                rail.addEventListener("pointermove", (e) => {
                    if (!dragging) return;

                    const dx = e.clientX - startPX;
                    if (Math.abs(dx) > 6) moved = true;

                    const now = performance.now();
                    const dt = Math.max(16, now - lastT);
                    vel = (e.clientX - lastPX) / dt; // px per ms
                    lastPX = e.clientX;
                    lastT = now;

                    applyX(startX + dx);
                    pickActiveFromX();
                });

                function endDrag(e) {
                    if (!dragging) return;
                    dragging = false;
                    rail.classList.remove("is-dragging");
                    try {
                        rail.releasePointerCapture(e.pointerId);
                    } catch {}

                    const clickedItem = pressItem;
                    pressItem = null;
                    if (clickedItem && !moved) {
                        setActive(clickedItem, {
                            snap: true,
                            announce: false,
                        });
                        openDetail(clickedItem);
                        return;
                    }

                    // inertia
                    if (!prefersReducedLocal) {
                        calcBounds();
                        const target = clamp(
                            x + vel * 260,
                            bounds.minX,
                            bounds.maxX,
                        );
                        gsap.to(track, {
                            x: target,
                            duration: 0.7,
                            ease: "power3.out",
                            onUpdate: () => {
                                x = gsap.getProperty(track, "x");
                                pickActiveFromX();
                            },
                        });
                    }

                    // snap
                    if (activeItem)
                        centerOnItem(activeItem, !prefersReducedLocal);
                }

                rail.addEventListener("pointerup", endDrag);
                rail.addEventListener("pointercancel", (e) => {
                    pressItem = null;
                    endDrag(e);
                });
                rail.addEventListener("lostpointercapture", () => {
                    dragging = false;
                    rail.classList.remove("is-dragging");
                    pressItem = null;
                });

                // wheel horizontal
                rail.addEventListener(
                    "wheel",
                    (e) => {
                        e.preventDefault();
                        hideHint();
                        calcBounds();

                        const delta =
                            Math.abs(e.deltaX) > Math.abs(e.deltaY)
                                ? e.deltaX
                                : e.deltaY;
                        applyX(x - delta);
                        pickActiveFromX();
                        if (activeItem) centerOnItem(activeItem, false);
                    },
                    {
                        passive: false,
                    },
                );

                window.addEventListener("resize", () => {
                    calcBounds();
                    applyX(x);
                    if (activeItem) centerOnItem(activeItem, false);
                });

                // detail overlay + typewriter
                let typeTween = null;

                function typewriter(text) {
                    if (!runText) return;
                    runText.classList.add("yex-typing-caret");
                    runText.textContent = "";
                    if (typeTween) typeTween.kill();

                    const obj = {
                        i: 0,
                    };
                    const dur = prefersReducedLocal
                        ? 0
                        : Math.min(2.2, Math.max(0.8, text.length / 45));
                    typeTween = gsap.to(obj, {
                        i: text.length,
                        duration: dur,
                        ease: "none",
                        onUpdate: () => {
                            runText.textContent = text.slice(
                                0,
                                Math.floor(obj.i),
                            );
                        },
                        onComplete: () => {
                            runText.textContent = text;
                        },
                    });
                }

                function openDetail(item) {
                    if (!detail || !detailPanel) return;

                    const year = item.dataset.year || "";
                    const ttl = item.dataset.title || "";
                    const body = item.dataset.body || "";

                    if (detailTitle) detailTitle.textContent = ttl || "—";
                    if (detailMeta)
                        detailMeta.textContent = `${year} • ${ttl}`.trim();
                    if (runText) runText.textContent = "";

                    detail.classList.add("is-open");
                    detail.setAttribute("aria-hidden", "false");
                    Sound.clickTick();

                    if (!prefersReducedLocal) {
                        gsap.killTweensOf([detailPanel]);
                        gsap.fromTo(
                            detailPanel,
                            {
                                opacity: 0,
                                y: 12,
                                scale: 0.99,
                            },
                            {
                                opacity: 1,
                                y: 0,
                                scale: 1,
                                duration: 0.28,
                                ease: "power2.out",
                            },
                        );
                    }

                    typewriter(body);
                }

                function closeDetail() {
                    if (!detail) return;
                    detail.setAttribute("aria-hidden", "true");

                    if (prefersReducedLocal) {
                        detail.classList.remove("is-open");
                        return;
                    }

                    if (detailPanel)
                        gsap.to(detailPanel, {
                            opacity: 0,
                            y: 10,
                            duration: 0.18,
                            ease: "power2.in",
                        });
                    gsap.to(detail, {
                        opacity: 0,
                        duration: 0.18,
                        ease: "power2.in",
                        onComplete: () => {
                            detail.classList.remove("is-open");
                            gsap.set(detail, {
                                clearProps: "opacity",
                            });
                        },
                    });
                }

                detailClose?.addEventListener("click", closeDetail);
                detailBackdrop?.addEventListener("click", closeDetail);
                window.addEventListener("keydown", (e) => {
                    if (e.key === "Escape") closeDetail();
                });

                // click items (open detail)
                items.forEach((item) => {
                    item.addEventListener("pointerenter", () =>
                        Sound.hoverTick(),
                    );

                    item.addEventListener("keydown", (e) => {
                        if (e.key === "Enter" || e.key === " ") {
                            e.preventDefault();
                            setActive(item, {
                                snap: true,
                                announce: false,
                            });
                            openDetail(item);
                        }
                    });
                });
            }

            initHistory();
            document.addEventListener("livewire:navigated", initHistory);
        })();
    })();
})();
