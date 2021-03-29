<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['*'], function ($view) {
            $end_time = now()->addDay(1);
            $setting = Cache::remember('category', $end_time, function () {
                return [
                    'category' => Category::with('products')->get(),
                ];
            });
            $view->with('setting', $setting);
        });
    }
}
