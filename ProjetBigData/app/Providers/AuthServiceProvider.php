<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Providers\Neo4jUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // ...

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function register()
    {
        Auth::provider('neo4j', function ($app, array $config) {
            return new Neo4jUserProvider($app['hash'], $config['model']);
        });
    }
}
