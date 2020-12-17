<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Back\Product;

class ProductController extends Controller
{
    public function menu()
    {
        return view('back.product.menu');
    }

    public function index(Request $request)
    {
        $jan_code = $request->input('jan_code');
        $name = $request->input('name');
        $description = $request->input('description');

        $query = Product::query();
        if (!is_null($jan_code)) $query->where('jan_code', 'LIKE', "%{$jan_code}%");
        if (!is_null($name)) $query->where('name', 'LIKE', "%{$name}%");
        if (!is_null($description)) $query->where('description', 'LIKE', "%{$description}%");

        $products = $query->paginate(10);

        return view('back.product.index', compact(
            'products',
            'jan_code',
            'name',
            'description',
        ));
    }
}
