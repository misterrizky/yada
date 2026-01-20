<?php
use App\Models\PM\Project;
use function Livewire\Volt\computed;

$collection = computed(function () {
    return Project::where('is_featured', 1)->get();
});
?>
<div class="bg-dark-50 sm:py-42 dark:bg-dark-900 flex justify-center dark:bg-dark-900 overflow-x-hidden">
    <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8 dark:bg-dark-900">
        <!-- <h2 class="text-base/7 font-semibold text-indigo-600 dark:text-indigo-400">Deploy faster</h2> -->
        <p
            class="mt-2 max-w-lg text-4xl font-semibold tracking-tight text-pretty text-dark-900 sm:text-5xl dark:text-white">
           Innovating Through Insight, Design, and Technology</p>
        <div class="mt-20 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-4 md:grid-rows-2">

            @foreach ($this->collection as $item)
                <div class="flex p-px lg:col-span-2">
                    <div
                        class="w-full overflow-hidden rounded-lg bg-dark shadow-sm outline outline-black/5 max-lg:rounded-t-4xl lg:rounded-tl-4xl dark:bg-dark-800 dark:shadow-none dark:outline-white/15 {{ $loop->odd ? 'gsap-fade-left' : 'gsap-fade-right' }}">
                        <img src="{{ asset('storage/' . ($item->projectGalleries->first()?->file_path ?? 'images/default.jpg')) }}"
                            alt="{{ $item->projectGalleries->first()?->title ?? 'Image Here' }}"
                            class="object-cover w-full aspect-[16/11]">
                        <div class="p-10">
                            <p class="mt-2 text-lg font-medium tracking-tight text-dark-900 dark:text-white">
                                {{ $item->name ?? 'Title Here' }}</p>
                            <p class="mt-2 max-w-lg text-sm/6 text-dark-600 dark:text-dark-400">
                                {{ $item->summary ?? 'Description Here' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
