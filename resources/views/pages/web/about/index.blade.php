<?php

use function Laravel\Folio\name;

name('web.about');
?>
<x-layouts.web :title="__('About Us - Enterprise Cloud & Software Development Company')" :description="__('')">
    <livewire:web.about.hero/>
    <livewire:web.shared.about/>
    <livewire:web.about.beliefs/>
    <livewire:web.about.history/>
    <livewire:web.about.team/>
    <livewire:web.about.blog/>
    <livewire:web.shared.cta/>

 <style>
  .custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
  }

  .custom-scrollbar::-webkit-scrollbar {
    height: 6px;
  }

  .custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background-color: #6366f1;
    /* indigo-500 */
  }
</style>
</x-layouts.web>