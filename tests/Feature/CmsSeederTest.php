<?php

namespace Tests\Feature;

use App\Models\CMS\Post;
use App\Models\User;
use Database\Seeders\CmsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_cms_seeder_creates_english_post_content(): void
    {
        User::factory()->create();

        $this->seed(CmsSeeder::class);

        $post = Post::query()
            ->where('title', 'International Grant Program Application Development Briefing - Phase 1')
            ->first();

        $this->assertNotNull($post);
        $this->assertStringContainsString('International Grant Program', $post->excerpt ?? '');
        $this->assertContains('international grants', $post->meta['tags'] ?? []);
    }
}
