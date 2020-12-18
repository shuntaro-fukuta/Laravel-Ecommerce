<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Back\CreateProductRequest;
use App\Http\Requests\Back\UpdateProductRequest;
use App\Models\Back\Product;
use App\Models\Back\Category;
use App\Models\Back\Maker;

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

    public function show(Product $product)
    {
        return view('back.product.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        $makers = Maker::all();

        return view('back.product.create', compact(
            'makers',
            'categories',
        ));
    }

    public function store(CreateProductRequest $request)
    {
        // TODO: きちんとJanの採番
        $jan_code = sprintf('%013d', mt_rand(0, 9999999999999));
        $product = Product::create(array_merge($request->all(), ['jan_code' => $jan_code]));

        return redirect(route('back.products.show', $product));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $makers = Maker::all();

        return view('back.product.edit', compact('product', 'categories', 'makers'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->all())->save();

        return redirect(route('back.products.show', $product));
    }
}
