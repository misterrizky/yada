<?php

namespace Tests\Feature;

use Livewire\Volt\Volt;
use Tests\TestCase;

class NotificationFormTest extends TestCase
{
    public function test_notification_shows_and_dismisses(): void
    {
        Volt::test('apps.shared.notification.form')
            ->assertSet('isVisible', false)
            ->call('showNotification', 'Test title', 'Test message')
            ->assertSet('isVisible', true)
            ->assertSet('title', 'Test title')
            ->assertSet('message', 'Test message')
            ->assertSee('Test title')
            ->assertSee('Test message')
            ->call('dismiss')
            ->assertSet('isVisible', false)
            ->assertDontSee('Test title')
            ->assertDontSee('Test message');
    }

    public function test_notification_dismiss_is_idempotent(): void
    {
        Volt::test('apps.shared.notification.form')
            ->call('dismiss')
            ->assertSet('isVisible', false);
    }

    public function test_notification_auto_close_is_configured(): void
    {
        Volt::test('apps.shared.notification.form')
            ->assertSee('setTimeout(() => { $wire.dismiss(); }, 5000);', false);
    }
}
