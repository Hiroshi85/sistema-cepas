<?php

namespace App\Providers\Academia;

use App\Services\Academia\AcademiaService;
use Illuminate\Support\ServiceProvider;

class AcademiaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('academia', function () {
            return new AcademiaService();
        });
    }

    public function boot(): void
    {
    }
}
