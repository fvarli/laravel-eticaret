<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

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

        // $expire_date = now()->addMinutes(10);
        // $statistics = Cache::remember('statistics', $expire_date, function (){
        //     return [
        //         'pending_order' => ProductOrder::where('status', 'Payment has been received.')->count()
        //     ];
        // });
        // View::share('statistics', $statistics);

        View::composer(['admin.*'], function ($view){
            $expire_date = now()->addMinutes(10);
            $statistics = Cache::remember('statistics', $expire_date, function (){
                return [
                    'pending_order' => ProductOrder::where('status', 'Payment has been received.')->count(),
                    'completed_order' => ProductOrder::where('status', 'Order has been completed.')->count(),
                    'total_product' => Product::count(),
                    'total_category' => Category::count(),
                    'total_user' => User::count(),
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
        //
    }
}
