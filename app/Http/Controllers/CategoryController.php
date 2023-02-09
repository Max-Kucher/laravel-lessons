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

        if (empty($req->itemsPerPage)) {
            $items_per_page = 2;
        } else {
            $items_per_page = $req->itemsPerPage;
        }

        $page = $req->page ?? 1;

        $products = Product::where('category_id', $item->id)
            ->orderBy($order_by, $sort_order)
            ->paginate($items_per_page);

        if ($req->ajax()) {
            return $order_by . '-' . $sort_order .preg_replace('/\s\s+/', ' ', view('ajax.products_ajax', [
                'products' => $products,
            ])->render());
        }

        return view('categories.view', [
            'category' => $item,
            'products' => $products,
            'pagination_page' => $page,
        ]);
    }
}
