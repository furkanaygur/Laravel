<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Debugbar;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers/timeConvert.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Debugbar::disable();

        View::composer(['*'], function ($view) {
            $end_time = now()->addDay(1);
            $setting = Cache::remember('category', $end_time, function () {
                return [
                    'category' => DB::select('SELECT * FROM category WHERE category.deleted_at IS NULL'),

                    'product' => DB::select('SELECT products.id, products.title, products.price, 
                    products.slug as productSlug, category.slug as categorySlug, product_detail.statu, 
                    product_detail.old_price FROM products 
                    INNER JOIN category_product ON category_product.product_id = products.id 
                    INNER JOIN product_detail ON product_detail.product_id = products.id
                    INNER JOIN category ON category.id = category_product.category_id
                    WHERE products.deleted_at IS NULL'),

                    'user' => DB::select('SELECT * FROM users 
                    INNER JOIN user_detail ON user_detail.user_id = users.id
                    WHERE users.deleted_at IS NULL'),

                    'order' => Order::with('cart')->get(),
                ];
            });
            $view->with('setting', $setting);
        });
    }
}
