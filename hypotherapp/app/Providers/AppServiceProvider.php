<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Client;
use App\Models\Poney;
use App\Policies\ClientPolicy;
use App\Policies\PoneyPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistrement des politiques d'autorisation.
     */
    public function boot(): void
    {
        Gate::policy(Client::class, ClientPolicy::class);
        Gate::policy(Poney::class, PoneyPolicy::class);
    }

    /**
     * Enregistrement des services de l'application.
     */
    public function register(): void
    {
        //
    }
}
