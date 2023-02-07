<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function view(Request $req, string $cat)
    {
        $item = Category::where('alias', $cat)->first();

        if (isset($req->sortBy) && isset($req->sortOrder)) {
            $order_by = $req->sortBy;
            $sort_order = $req->sortOrder;
        } else {
            $order_by = 'id';
            $sort_order = 'asc';
        }

        $products = Product::where('category_id', $item->id)
            ->orderBy($order_by, $sort_order)
            ->get();

        if ($req->ajax()) {
            return $order_by . '-' . $sort_order .preg_replace('/\s\s+/', ' ', view('ajax.products_ajax', [
                'products' => $products,
            ])->render());
        }

        return view('categories.view', [
            'category' => $item,
            'products' => $products,
        ]);
    }
}
