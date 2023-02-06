<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function view(string $cat) : View
    {
        $item = Category::where('alias', $cat)->first();

        return view('categories.view', [
            'category' => $item,
        ]);
    }
}
