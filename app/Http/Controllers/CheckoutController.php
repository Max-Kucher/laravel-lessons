<?php

namespace App\Http\Controllers;

use App\Product;
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
        if (!isset($req->product_id)) {
            abort(403);
            return '';
        }

        $cart_id = $_COOKIE['cart_id'];
        $cart = \Cart::session($cart_id);

        $product = Product::where('id', $req->product_id)->first();

        $cart->add([
            'id' => $req->product_id,
            'name' => $product->product,
            'price' => $product->price,
            'quantity' => intval($req->amount ?? 1),
            'attributes' => [],
            'associatedModel' => $product,
        ]);

        return response()->json([
            'cart' => $cart->getContent(),
            'total' => $cart->getTotalQuantity(),
        ]);
    }
}
