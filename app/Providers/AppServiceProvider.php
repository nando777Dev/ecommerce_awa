<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        $asset_v =  config('constants.asset_version', default: 1);
        View::share('asset_v', $asset_v);


        $business_id = config('constants.business_id', default: 1);

        View::share('business_id', $business_id);
    }
}
