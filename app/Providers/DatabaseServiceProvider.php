<?php

namespace App\Providers;

use App\Database\Connectors\KoyebPostgresConnector;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\DatabaseManager;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Register custom Koyeb PostgreSQL connector
        $this->app->singleton('db.connector.koyeb_pgsql', function () {
            return new KoyebPostgresConnector();
        });

        // Replace the default pgsql connector if needed
        Connection::resolverFor('pgsql', function ($connection, $database, $prefix, $config) {
            $connector = new KoyebPostgresConnector();
            $pdo = $connector->connect($config);
            return new \Illuminate\Database\PostgresConnection($pdo, $database, $prefix, $config);
        });
    }
}
