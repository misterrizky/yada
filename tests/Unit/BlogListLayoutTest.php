<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BlogListLayoutTest extends TestCase
{
    public function test_blog_list_layout_uses_three_by_six_grid(): void
    {
        $path = dirname(__DIR__, 2).'/resources/views/livewire/web/blogs/list.blade.php';
        $contents = file_get_contents($path);

        $this->assertNotFalse($contents);
        $this->assertStringContainsString('lg:grid-cols-4', $contents);
        $this->assertStringContainsString('const itemsPerPage = 12;', $contents);
    }
}
