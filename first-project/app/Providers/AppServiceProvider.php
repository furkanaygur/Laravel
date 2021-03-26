<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Users;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer(['admin.*'], function ($view) {
            $end_time = now()->addMinutes(10);
            $statistics = Cache::remember('statistics', $end_time, function () {
                return [
                    'orders' => Orders::count(),
                    'waiting_orders' => Orders::where('statu', 'Order has been taken')->count(),
                    'cargo_orders' => Orders::where('statu', 'Given to cargo')->count(),
                    'done_orders' => Orders::where('statu', 'Done')->count(),
                    'categories' => Category::count(),
                    'users' => Users::count(),
                    'products' => Product::count(),
                ];
            });

            $view->with('statistics', $statistics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers/timeConvert.php';
    }
}
