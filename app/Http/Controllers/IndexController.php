<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $products = Product::where('in_stock', true)->orderBy('created_at')->take(8)->get();

        return view('index.index', [
            'products' => $products,
        ]);
    }
}
