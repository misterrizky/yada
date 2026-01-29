@props([
    'name',
    'title',
    'subheading' => null,
    'submit' => 'save',
    'close' => 'resetModal',
    'width' => 'md:w-lg',
    'variant' => 'floating',
    'flyout' => true,
    'loadingTarget' => null,
    'submitLabel' => 'Save',
    'loadingLabel' => 'Saving...',
    'cancelLabel' => 'Cancel',
])

@php
    $loadingTarget = $loadingTarget ?? $submit;
    $extraClass = (string) $attributes->get('class');
    $modalClass = trim($width . ' ' . $extraClass);
@endphp

<flux:modal
    name="{{ $name }}"
    variant="{{ $variant }}"
    :flyout="$flyout"
    @close="{{ $close }}"
    class="{{ $modalClass }}"
>
    <form wire:submit.prevent="{{ $submit }}" class="flex flex-col gap-6">
        <div class="space-y-1">
            <flux:heading size="lg">{{ $title }}</flux:heading>
            @if ($subheading)
                <flux:subheading>{{ $subheading }}</flux:subheading>
            @endif
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </div>

        @if (isset($actions))
            {{ $actions }}
        @else
            <div class="flex items-center justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="filled" type="button">
                        {{ $cancelLabel }}
                    </flux:button>
                </flux:modal.close>

            <flux:button
                type="submit"
                variant="primary"
                wire:loading.attr="disabled"
                :wire:target="$loadingTarget"
            >
                    <span wire:loading.remove wire:target="{{ $loadingTarget }}">{{ $submitLabel }}</span>
                    <span wire:loading wire:target="{{ $loadingTarget }}">{{ $loadingLabel }}</span>
                </flux:button>
            </div>
        @endif
    </form>
</flux:modal>
