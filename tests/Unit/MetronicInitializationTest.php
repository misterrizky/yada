<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class MetronicInitializationTest extends TestCase
{
    public function test_metronic_initialization_includes_dropdowns_and_dom_ready_bootstrap(): void
    {
        $path = dirname(__DIR__, 2).'/resources/js/app.js';
        $contents = file_get_contents($path);

        $this->assertNotFalse($contents);
        $this->assertStringContainsString('KTDropdown.init', $contents);
        $this->assertStringContainsString('DOMContentLoaded', $contents);
        $this->assertStringContainsString('initializeMetronic', $contents);
        $this->assertStringContainsString('livewire:navigated', $contents);
    }
}
