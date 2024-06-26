<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View as ViewContract;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();
        View::composer(['layout.header','cart.checkout'], function (ViewContract $view) {
            if(Session::has('cart')){
                $oldCart = Session::get('cart'); // Session cart created in addToCart method of PageController
                $cart = new Cart($oldCart);
                $view->with([
                    'cart' => $cart,
                    'productCarts' => $cart->items,
                    'totalPrice' => $cart->totalPrice,
                    'totalQty' => $cart->totalQty
                ]);
            }
        }); 
    }
}