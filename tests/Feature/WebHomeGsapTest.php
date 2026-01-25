<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebHomeGsapTest extends TestCase
{
    use RefreshDatabase;

    public function test_web_home_includes_gsap_hooks(): void
    {
        $response = $this->withServerVariables([
            'HTTP_HOST' => 'erp.test',
        ])->get(route('web.home', [], false));

        $response->assertStatus(200);
        $response->assertSee('data-theme=', false);
        $response->assertSee('data-theme-toggle', false);
        $response->assertSee('id="btnExplore"', false);
        $response->assertSee('id="megaExplore"', false);
        $response->assertSee('gsap-fade-up', false);
        $response->assertSee('initGsap()', false);
    }
}
