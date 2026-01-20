<?php

use App\Models\Master\Industry;
use function Laravel\Folio\name;
use function Livewire\Volt\{computed};

name('web.works');

$industries = computed(function () {
    return Industry::limit(10)->get();
});
?>
<x-layouts.web :title="__('YE - Software Company in Indonesia')" :description="__('Explore our proven works in software development, UX/UI design, AI, and digital product transformation.')" :keywords="__('works, portfolio, development, design')">
    <livewire:web.works.hero/>
    <livewire:web.works.featured-project/>
    <livewire:web.works.portfolio/>
    <livewire:web.shared.cta/>
</x-layouts.web>
<script>
  // Ensure GSAP + ScrollTrigger are available (CDN fallback)
  function ensureGsap(callback) {
    if (window.gsap && window.ScrollTrigger) {
      return callback();
    }

    const loadScript = (src) => new Promise((resolve, reject) => {
      const s = document.createElement('script');
      s.src = src;
      s.async = true;
      s.onload = resolve;
      s.onerror = reject;
      document.head.appendChild(s);
    });

    (async () => {
      try {
        if (!window.gsap) {
          await loadScript('https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js');
        }
        if (!window.ScrollTrigger) {
          await loadScript('https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js');
        }
      } catch (e) {
        console.warn('Failed to load GSAP from CDN:', e);
      } finally {
        callback();
      }
    })();
  }

  // ==============================
  // SPLIT TEXT FUNCTION (FREE)
  // ==============================
  function splitTextToSpans(selector) {
    document.querySelectorAll(selector).forEach(el => {
      if (el.dataset.split === "true") return;

      const text = el.innerText;
      el.innerHTML = "";

      const words = text.split(" ");

      words.forEach((word, wIndex) => {
        const wordSpan = document.createElement("span");
        wordSpan.style.display = "inline-block";
        wordSpan.style.whiteSpace = "nowrap";

        const letters = word.split("");

        letters.forEach(letter => {
          const span = document.createElement("span");
          span.innerText = letter;
          span.style.display = "inline-block";
          span.classList.add("split-char");
          wordSpan.appendChild(span);
        });

        el.appendChild(wordSpan);

        if (wIndex < words.length - 1) {
          el.appendChild(document.createTextNode(" "));
        }
      });

      el.dataset.split = "true";
    });
  }

  function initGsap() {
    ensureGsap(() => {
      try {
        gsap.registerPlugin(ScrollTrigger);

        // Kill old triggers (important for SPA / Livewire)
        ScrollTrigger.getAll().forEach(t => t.kill());

        // ==============================
        // PREPARE SPLIT TEXT
        // ==============================
        splitTextToSpans(".split-text");
        splitTextToSpans(".split-text-desc");

        // ==============================
        // Fade Left
        // ==============================
        gsap.utils.toArray(".gsap-fade-left").forEach((el) => {
          gsap.fromTo(el, {
            opacity: 0,
            x: -80
          }, {
            opacity: 1,
            x: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
              end: "bottom 20%",
              toggleActions: "play reverse play reverse"
            }
          });
        });

        // ==============================
        // Fade Right
        // ==============================
        gsap.utils.toArray(".gsap-fade-right").forEach(el => {
          gsap.fromTo(el, {
            x: 80,
            opacity: 0
          }, {
            x: 0,
            opacity: 1,
            duration: 1.1,
            ease: "power3.out",
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
              end: "bottom 20%",
              toggleActions: "play reverse play reverse"
            }
          });
        });

        // ==============================
        // Fade Up
        // ==============================
        gsap.utils.toArray(".gsap-fade-up").forEach(el => {
          gsap.fromTo(el, {
            y: 60,
            opacity: 0
          }, {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
              end: "bottom 20%",
              toggleActions: "play reverse play reverse"
            }
          });
        });

        // ==============================
        // Fade Down
        // ==============================
        gsap.utils.toArray(".gsap-fade-down").forEach(el => {
          gsap.fromTo(el, {
            y: -60,
            opacity: 0
          }, {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
              end: "bottom 20%",
              toggleActions: "play reverse play reverse"
            }
          });
        });

        // ==============================
        // Stagger Blog List
        // ==============================
        gsap.utils.toArray(".blog-list").forEach(list => {
          const items = list.querySelectorAll(".blog-item");

          gsap.fromTo(items, {
            y: 50,
            opacity: 0
          }, {
            y: 0,
            opacity: 1,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.15,
            scrollTrigger: {
              trigger: list,
              start: "top 80%",
            }
          });
        });

        // ==============================
        // Parallax Image
        // ==============================
        gsap.utils.toArray(".gsap-parallax").forEach(img => {
          gsap.to(img, {
            y: -80,
            ease: "none",
            scrollTrigger: {
              trigger: img,
              start: "top bottom",
              end: "bottom top",
              scrub: true
            }
          });
        });

        // ==============================
        // SPLIT TEXT ANIMATION (NEW)
        // ==============================
        gsap.utils.toArray(".split-text").forEach(el => {
          const chars = el.querySelectorAll(".split-char");

          gsap.fromTo(chars, {
            y: 60,
            opacity: 0,
            rotateX: 90
          }, {
            y: 0,
            opacity: 1,
            rotateX: 0,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.02,
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
            }
          });
        });
        gsap.utils.toArray(".split-text-desc").forEach(el => {
          const chars = el.querySelectorAll(".split-char");

          gsap.fromTo(chars, {
            y: 60,
            opacity: 0,
            rotateX: 90
          }, {
            y: 0,
            opacity: 1,
            rotateX: 0,
            duration: 0.1,
            ease: "power3.out",
            stagger: 0.005,
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
            }
          });
        });

      } catch (err) {
        console.error('GSAP init error:', err);
      }
    });
  }

  // ==============================
  // Run on load
  // ==============================
  document.addEventListener("DOMContentLoaded", () => {
    initGsap();
  });

  // ==============================
  // If using Livewire / SPA / Turbo
  // ==============================
  document.addEventListener("livewire:navigated", () => {
    setTimeout(() => initGsap(), 50);
  });

  document.addEventListener("turbo:load", () => {
    setTimeout(() => initGsap(), 50);
  });

  // ==============================
  // Fallback
  // ==============================
  if (document.readyState !== 'loading') {
    initGsap();
  }
</script>