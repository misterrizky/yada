<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;

class FolioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Folio::domain('yada.test')->path(resource_path('views/pages/apps'))->middleware([
            '*' => [
                'auth',
                'verified',
            ],
        ]);
        Folio::domain('yada.test')->path(resource_path('views/pages/sso'))->middleware([
            '*' => [
                //
            ],
        ]);
        Folio::domain('yex.co.id')->path(resource_path('views/pages/web'))->middleware([
            '*' => [
                //
            ],
        ]);
    }
}
