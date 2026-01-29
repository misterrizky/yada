<?php

use App\Models\CMS\Post;
use App\Models\CMS\PostCategoryPost;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Volt\Component;
use function Livewire\Volt\{state};
use function Laravel\Folio\name;


name('web.blogs.show');

new class extends Component {
    public Post $post;

    #[\Livewire\Attributes\Computed]
    public function relatedPosts(): Collection
    {
        $categoryIds = PostCategoryPost::query()
            ->where('post_id', $this->post->id)
            ->pluck('post_category_id');

        $relatedPostsQuery = Post::query()
            ->whereKeyNot($this->post->id);

        if ($categoryIds->isNotEmpty()) {
            $relatedPostsQuery->whereHas('postCategoryPosts', function ($query) use ($categoryIds) {
                $query->whereIn('post_category_id', $categoryIds);
            });
        }

        return $relatedPostsQuery
            ->latest('published_at')
            ->limit(3)
            ->get();
    }
};
?>
<x-layouts.web :title="__($post->seo_title ?? $post->title)" :description="__($post->seo_description ?? $post->excerpt ?? '')">
    @volt
    <div>
        <section class="bg-white py-16 sm:py-20 dark:bg-black">
            <div class="mx-auto flex max-w-4xl flex-col gap-8 px-6 lg:px-8">
                <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('web.blogs') }}" wire:navigate class="font-semibold text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                        Blog
                    </a>
                    <span aria-hidden="true">/</span>
                    <span class="text-gray-600 dark:text-gray-400">{{ $post->title }}</span>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
                        {{ $post->title }}
                    </h1>

                    @if ($post->published_at)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->published_at->format('d M Y') }}</p>
                    @endif

                    @if ($post->excerpt)
                        <p class="text-lg leading-7 text-gray-600 dark:text-gray-300">{{ $post->excerpt }}</p>
                    @endif
                </div>

                @if ($post->featured_image)
                    <div class="overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800">
                        <img
                            src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->title }}"
                            class="h-full w-full object-cover"
                        />
                    </div>
                @endif

                <div class="text-base leading-7 text-gray-700 dark:text-gray-300 whitespace-pre-line">
                    {!! $post->content !!}
                </div>
            </div>
        </section>

        @if ($this->relatedPosts->isNotEmpty())
            <section class="bg-gray-50 py-16 sm:py-20 dark:bg-black">
                <div class="mx-auto flex max-w-6xl flex-col gap-8 px-6 lg:px-8">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">Related posts</p>
                            <h2 class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Keep reading</h2>
                        </div>
                        <a href="{{ route('web.blogs') }}" wire:navigate class="text-sm font-semibold text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            View all blogs
                        </a>
                    </div>

                    <div class="grid gap-8 lg:grid-cols-3">
                        @foreach ($this->relatedPosts as $relatedPost)
                            <article class="flex h-full flex-col gap-6">
                                <div class="relative w-full overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800">
                                    <img
                                        src="{{ asset('storage/' . ($relatedPost->featured_image ?? 'images/default.jpg')) }}"
                                        alt="{{ $relatedPost->title }}"
                                        class="h-full w-full object-cover"
                                    />
                                    <div class="absolute inset-0 rounded-2xl inset-ring inset-ring-gray-900/10 dark:inset-ring-white/10"></div>
                                </div>

                                <div class="flex grow flex-col gap-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $relatedPost->published_at?->format('d M Y') ?? $relatedPost->created_at?->format('d M Y') }}
                                    </p>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        <a href="{{ route('web.blogs.show', ['post' => $relatedPost]) }}" wire:navigate class="hover:text-gray-600 dark:hover:text-gray-300">
                                            {{ $relatedPost->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm leading-6 text-gray-600 dark:text-gray-400">
                                        {{ Str::limit(strip_tags($relatedPost->excerpt ?? $relatedPost->content ?? ''), 140) }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
    @endvolt
</x-layouts.web>
