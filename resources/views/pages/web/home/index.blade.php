<?php

use function Laravel\Folio\name;

name('web.home');
?>
<x-layouts.web :title="__('YE - Software Company in Indonesia')" :description="__('YE delivers full-service software, AI, QA, and cloud solutions to modernize and grow your business.')" :keywords="__('Software Company in Indonesia, AI, QA, and cloud solutions, modernize and grow your business')">



        <section>
            <livewire:web.home.hero />
        </section>

        <section class="gsap-fade-up">
            <livewire:web.shared.featured-project />
        </section>

        <section class="gsap-fade-up">
            <livewire:web.shared.about />
        </section>

        <livewire:web.home.solution />

        <section class="gsap-fade-up">
            <livewire:web.shared.testimonial />
        </section>

        <section class="gsap-fade-up">
            <livewire:web.shared.client-cloud />
        </section>

        <section class="gsap-fade-up">
            <livewire:web.shared.blog />
        </section>

        <section class="gsap-fade-up">
            <livewire:web.shared.cta />
        </section>


</x-layouts.web>
