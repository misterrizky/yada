<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SolutionSectionMarkupTest extends TestCase
{
    public function test_solution_cards_render_expanded_by_default(): void
    {
        $path = dirname(__DIR__, 2).'/resources/views/livewire/web/home/solution.blade.php';
        $contents = file_get_contents($path);

        $this->assertNotFalse($contents);
        $this->assertSame(4, substr_count($contents, 'data-card-mode="static"'));
        $this->assertSame(7, substr_count($contents, 'class="card-item active"'));
        $this->assertStringContainsString('object-left', $contents);
    }

    public function test_solution_cards_static_mode_assets_present(): void
    {
        $scriptPath = dirname(__DIR__, 2).'/resources/js/app.js';
        $scriptContents = file_get_contents($scriptPath);

        $this->assertNotFalse($scriptContents);
        $this->assertStringContainsString('dataset.cardMode', $scriptContents);
        $this->assertStringContainsString('cardMode === "static"', $scriptContents);

        $stylePath = dirname(__DIR__, 2).'/resources/css/app.css';
        $styleContents = file_get_contents($stylePath);

        $this->assertNotFalse($styleContents);
        $this->assertStringContainsString('process-flow-container[data-card-mode="static"]', $styleContents);
        $this->assertStringContainsString('data-card-mode="static"] .card-item', $styleContents);
        $this->assertStringContainsString('cursor: default', $styleContents);
        $this->assertStringContainsString('height: auto', $styleContents);
        $this->assertStringContainsString('align-items: stretch', $styleContents);
    }
}
