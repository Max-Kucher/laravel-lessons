<?php

namespace App\Providers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
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
        $categories = Category::all();
        $req = app(Request::class);

        if (empty($_COOKIE['cart_id'])) {
            $cart_id = uniqid(md5($req->ip()));

            setcookie('cart_id', $cart_id, time() + 3600 * 24);
        } else {
            $cart_id = $_COOKIE['cart_id'];
        }

        $cart = \Cart::session($cart_id);

        View::share([
            'menu_categories' => $categories,
            'cart' => $cart,
        ]);
    }
}
