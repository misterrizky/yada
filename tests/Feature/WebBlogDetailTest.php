<?php

namespace Tests\Feature;

use App\Models\CMS\Post;
use App\Models\CMS\PostCategory;
use App\Models\CMS\PostCategoryPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebBlogDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_web_blog_detail_page_displays_post_content(): void
    {
        $post = Post::forceCreate([
            'title' => 'Test Blog Post',
            'slug' => 'test-blog-post',
            'content' => 'This is the blog detail content.',
            'excerpt' => 'A short excerpt.',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->withServerVariables([
            'HTTP_HOST' => 'erp.test',
        ])->get(route('web.blogs.show', $post, false));

        $response->assertStatus(200);
        $response->assertSee('Test Blog Post');
        $response->assertSee('This is the blog detail content.');
    }

    public function test_web_blog_detail_page_shows_related_posts(): void
    {
        $post = Post::forceCreate([
            'title' => 'Main Post',
            'slug' => 'main-post',
            'content' => 'Main post content.',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        $relatedPost = Post::forceCreate([
            'title' => 'Related Post',
            'slug' => 'related-post',
            'content' => 'Related post content.',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $unrelatedPost = Post::forceCreate([
            'title' => 'Unrelated Post',
            'slug' => 'unrelated-post',
            'content' => 'Unrelated post content.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $category = PostCategory::forceCreate([
            'name' => 'News',
            'slug' => 'news',
        ]);

        PostCategoryPost::forceCreate([
            'post_id' => $post->id,
            'post_category_id' => $category->id,
        ]);

        PostCategoryPost::forceCreate([
            'post_id' => $relatedPost->id,
            'post_category_id' => $category->id,
        ]);

        $response = $this->withServerVariables([
            'HTTP_HOST' => 'erp.test',
        ])->get(route('web.blogs.show', $post, false));

        $response->assertStatus(200);
        $response->assertSee('Related Post');
        $response->assertDontSee('Unrelated Post');
    }
}
