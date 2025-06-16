<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
        $category =  category::with('products')
            ->orderBy('created_at', 'asc')
            ->limit(4)
            ->get();
        view()->share('category', $category);
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartUser = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get();
                $view->with('cartUser', $cartUser);
            }
        });
    }
}
