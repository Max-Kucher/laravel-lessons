<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function cart(Request $req) : View
    {
        return view('checkout.cart');
    }

    public function addToCart(Request $req)
    {
        return response()->json([
            'data' => $req->ip()
        ]);
    }
}
