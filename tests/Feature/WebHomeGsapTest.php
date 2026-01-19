<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebHomeGsapTest extends TestCase
{
    public function test_web_home_includes_gsap_hooks(): void
    {
        $response = $this->withServerVariables([
            'HTTP_HOST' => 'erp.test',
        ])->get(route('web.home', [], false));

        $response->assertStatus(200);
        $response->assertSee('data-home-root', false);
        $response->assertSee('data-home-hero', false);
        $response->assertSee('data-home-solution', false);
        $response->assertSee('data-home-cta', false);
    }
}
