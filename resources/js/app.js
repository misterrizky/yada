import AOS from 'aos';
import GLightbox from 'glightbox';
import Swiper from 'swiper/bundle';
import { Autoplay } from "swiper/modules";

import 'swiper/css/bundle';
import 'aos/dist/aos.css'; // You can also use <link> for styles
import '@tailwindplus/elements';

AOS.init();
(() => {
    const storageKey = "theme";
    const root = document.documentElement;

    const getInitialTheme = () => {
        const stored = localStorage.getItem(storageKey);
        if (stored === "dark" || stored === "light") return stored;
        return root.getAttribute("data-theme") || "light";
    };

    const applyTheme = (theme) => {
        root.setAttribute("data-theme", theme);
    };

    // Apply theme sekali (persist via localStorage)
    applyTheme(getInitialTheme());

    // Event delegation: tetap jalan meski Livewire navigasi & DOM berganti
    document.addEventListener("click", (e) => {
        const toggleButton = e.target.closest("[data-theme-toggle]");
        if (!toggleButton) return;

        const nextTheme =
        root.getAttribute("data-theme") === "dark" ? "light" : "dark";

        applyTheme(nextTheme);
        localStorage.setItem(storageKey, nextTheme);
    });
    function initGallery(){
        const swiper = new Swiper(".gallerySlider", {
    
            centeredSlides: true,
            loop: true,
            spaceBetween: 20,
            speed: 1000,

            effect: "coverflow",
            module:[Autoplay],
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },

            coverflowEffect: {
                rotate: 40,
                stretch: 0,
                depth: 120,
                modifier: 1,
                slideShadows: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
            
            },

        });
    }
    function initCards() {
        document.querySelectorAll(".card-item").forEach((card) => {
            if (card.dataset.cardBound) return;
            card.dataset.cardBound = "1";

            card.addEventListener("click", () => {
                if (card.classList.contains("active")) return;

                document.querySelectorAll(".card-item.active").forEach((c) => c.classList.remove("active"));
                card.classList.add("active");
            });
        });
    }
    function horizontalText(){
        gsap.registerPlugin(SplitText);
        let wrapper = document.querySelector(".Horizontal");
        let text = document.querySelector(".Horizontal__text");
        let split = SplitText.create(".Horizontal__text", { type: "chars, words" });

        const scrollTween = gsap.to(text, {
            xPercent: -100,
            ease: "none",
            scrollTrigger: {
                trigger: wrapper,
                pin: true,
                end: "+=5000px",
                scrub: true
            }
        });
        split.chars.forEach((char) => {
            gsap.from(char, {
                yPercent: "random(-200, 200)",
                rotation: "random(-20, 20)",
                ease: "back.out(1.2)",
                scrollTrigger: {
                trigger: char,
                containerAnimation: scrollTween,
                start: "left 100%",
                end: "left 30%",
                scrub: 1
                }
            });
        });
    }
    function homeHeroTitle() {
        const title = document.getElementById("hero-title");
        if (!title) return;

        const words = title.innerText.trim().split(/\s+/);

        title.innerHTML = words
            .map(word => `<span class="inline-block opacity-0">${word}</span>`)
            .join(" ");

        gsap.fromTo(
            "#hero-title span",
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.08,
                ease: "power3.out",
            }
        );
    }
    function initThemeToggle() {
        const btn = document.querySelector("[data-theme-toggle]");
        if (!btn || btn.dataset.bound) return;
        btn.dataset.bound = "1";

        btn.addEventListener("click", () => { /* toggle theme */ });
    }
    document.addEventListener("livewire:navigated", () =>{
        horizontalText();
        homeHeroTitle();
        initGallery();
        initCards();
        initThemeToggle();
    });
    document.addEventListener("DOMContentLoaded", () =>{
        horizontalText();
        homeHeroTitle();
        initGallery();
        initCards();
        initThemeToggle();
    });
})();