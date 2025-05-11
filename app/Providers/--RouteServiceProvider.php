<?php
namespace App\Providers;


class RouteServiceProvider extends ServiceProvider
{

public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')->group(base_path('routes/web.php'));
            Route::middleware('web')->group(base_path('routes/customer.php'));
            Route::middleware('web')->group(base_path('routes/partner.php'));
        });
    }

}