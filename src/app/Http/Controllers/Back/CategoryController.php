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

    public function index()
    {
        $categories = Category::all();

        return view('back.category.index', compact('categories'));
    }
}
