<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FolioServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    Barryvdh\DomPDF\ServiceProvider::class,
    Cmgmyr\Messenger\MessengerServiceProvider::class,
    Cog\Laravel\Ban\Providers\BanServiceProvider::class,
    Plank\Mediable\MediableServiceProvider::class,
    Plank\Metable\MetableServiceProvider::class,
];