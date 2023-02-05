<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function view(string $cat, int $p_id) : View
    {
        $item = Product::where('id', $p_id)->first();

        return view('products.view', [
            'product' => $item,
        ]);
    }
}
