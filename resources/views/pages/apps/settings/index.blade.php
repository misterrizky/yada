<?php
use function Laravel\Folio\name;
use function Livewire\Volt\state;

state([
    'layout' => fn () => app(\App\Settings\AppearanceSettings::class)->layout_app,
    'theme' => fn () => app(\App\Settings\AppearanceSettings::class)->theme_app,
]);

name('app.settings');
?>
<x-layouts.app :title="__('Settings')">
    @volt
        <div>
            @if ($this->theme == "flux")
                <flux:heading size="xl">Settings</flux:heading>
                <flux:separator variant="subtle" class="my-8" />
                <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
                    <div class="w-80">
                        <flux:heading size="lg">Profile</flux:heading>
                        <flux:subheading>This is how others will see you on the site.</flux:subheading>
                    </div>
                    <div class="flex-1 space-y-6">
                        <flux:input
                            label="Username"
                            description="This is your public display name. It can be your real name or a pseudonym. You can only change this once every 30 days."
                            placeholder="calebporzio"
                        />
                        <flux:select
                            label="Primary email"
                            description:trailing="You can manage verified email addresses in your email settings."
                            placeholder="Select primary email..."
                        >
                            <flux:select.option>lotrrules22@aol.com</flux:select.option>
                            <flux:select.option>phantomatrix@hotmail.com</flux:select.option>
                        </flux:select>
                        <flux:textarea
                            label="Bio"
                            description:trailing="You can @mention other users and organizations to link to them."
                            placeholder="Tell us a little bit about yourself"
                        />
                        <div class="flex justify-end">
                            <flux:button type="submit" variant="primary">Save profile</flux:button>
                        </div>
                    </div>
                </div>
                <flux:separator variant="subtle" class="my-8" />
                <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
                    <div class="w-80">
                        <flux:heading size="lg">Preferences</flux:heading>
                        <flux:subheading>Customize your layout and notification preferences.</flux:subheading>
                    </div>
                    <div class="flex-1 space-y-6">
                        <flux:checkbox.group label="Sidebar" description="Select the items you want to display in the sidebar.">
                            <flux:checkbox value="recents" label="Recents" checked />
                            <flux:checkbox value="home" label="Home" checked />
                            <flux:checkbox value="applications" label="Applications" />
                            <flux:checkbox value="desktop" label="Desktop" />
                        </flux:checkbox.group>
                        <flux:separator variant="subtle" class="my-8" />
                        <flux:radio.group label="Notify me about...">
                            <flux:radio value="all" label="All new messages" checked />
                            <flux:radio value="direct" label="Direct messages and mentions" />
                            <flux:radio value="none" label="Nothing" />
                        </flux:radio.group>
                        <div class="flex justify-end">
                            <flux:button type="submit" variant="primary">Save preferences</flux:button>
                        </div>
                    </div>
                </div>
                <flux:separator variant="subtle" class="my-8" />
                <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 pb-10">
                    <div class="w-80">
                        <flux:heading size="lg">Email notifications</flux:heading>
                        <flux:subheading>Choose which emails you'd like to get from us.</flux:subheading>
                    </div>
                    <div class="flex-1 space-y-6">
                        <flux:fieldset class="space-y-4">
                            <flux:switch checked label="Communication emails" description="Receive emails about your account activity." />
                            <flux:separator variant="subtle" />
                            <flux:switch checked label="Marketing emails" description="Receive emails about new products, features, and more." />
                            <flux:separator variant="subtle" />
                            <flux:switch label="Social emails" description="Receive emails for friend requests, follows, and more." />
                            <flux:separator variant="subtle" />
                            <flux:switch label="Security emails" description="Receive emails about your account activity and security." />
                        </flux:fieldset>
                    </div>
                </div>
            @else
                <div>
                    asd
                </div>
            @endif
        </div>
    @endvolt
</x-layouts.app>
