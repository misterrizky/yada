<?php

use function Laravel\Folio\name;

name('two-factor.login');
?>
<x-layouts.auth>
    <livewire:sso.two-factor-challenge />
</x-layouts.auth>
