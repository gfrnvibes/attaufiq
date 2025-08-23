<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function (QueryExecuted $query) {
            $is_insert = strpos($query->sql, "insert into") !== false;
            $is_orderitem = strpos($query->sql, "order_items") !== false;
            $is_mediaitem = strpos($query->sql, "media") !== false;
            if ($is_insert && ($is_orderitem || $is_mediaitem)) {
                Log::info(
                    $query->sql,
                    [
                        'bindings' => $query->bindings,
                        'time' => $query->time
                    ]
                );
            }

        });
    }
}
