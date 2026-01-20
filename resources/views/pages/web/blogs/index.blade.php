<?php

use function Laravel\Folio\name;

name('web.blogs');
?>
<x-layouts.web :title="__('Blog | Technology, Business Digital Transformation | YE')" :description="__('')">
    <livewire:web.blogs.hero>
    <livewire:web.blogs.list>
</x-layouts.web>