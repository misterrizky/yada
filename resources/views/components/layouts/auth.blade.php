@php
    $auth = app(\App\Settings\AppearanceSettings::class);
    $layout = $auth->layout_auth;
@endphp
<x-dynamic-component :component="'layouts.auth.' . $layout" :title="$title ?? null">
    {{ $slot }}
</x-dynamic-component>
