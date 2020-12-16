<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Back\Category;
use App\Http\Requests\Back\CreateCategoryRequest;
use App\Http\Requests\Back\UpdateCategoryRequest;

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

    public function show(Category $category)
    {
        return view('back.category.show', compact('category'));
    }

    public function create()
    {
        return view('back.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return redirect(route('back.categories.show', $category));
    }

    public function edit(Category $category)
    {
        return view('back.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();

        return redirect(route('back.categories.show', $category));
    }
}
