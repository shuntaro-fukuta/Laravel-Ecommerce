<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Back\Category;

class CategoryController extends Controller
{
    public function menu()
    {
        return view('back.category.menu');
    }

    public function index(Request $request)
    {
        $name = $request->input('name');

        $query = Category::query();
        if (!is_null($name)) $query->where('name', 'LIKE', "%{$name}%");

        $categories = $query->paginate(10);

        return view('back.category.index', compact('categories', 'name'));
    }
}
