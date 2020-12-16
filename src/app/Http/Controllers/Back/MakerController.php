<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Back\Maker;
use App\Http\Requests\Back\CreateMakerRequest;
use App\Http\Requests\Back\UpdateMakerRequest;

class MakerController extends Controller
{
    public function menu()
    {
        return view('back.maker.menu');
    }

    public function index(Request $request)
    {
        $makers = Maker::all();

        $name = $request->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');

        $query = Maker::query();
        if (!is_null($name)) $query->where('name', 'LIKE', "%{$name}%");
        if (!is_null($email)) $query->where('email', 'LIKE', "%{$email}%");
        if (!is_null($phone_number)) $query->where('phone_number', 'LIKE', "%{$phone_number}%");
        if (!is_null($address)) $query->where('address', 'LIKE', "%{$address}%");

        $makers = $query->paginate(10);

        return view('back.maker.index', compact('makers', 'name', 'email', 'phone_number', 'address'));
    }

    public function create()
    {
        return view('back.maker.create');
    }

    public function store(CreateMakerRequest $request)
    {
        $maker = Maker::create($request->all());

        return redirect(route('back.makers.show', $maker));
    }

    public function show(Maker $maker)
    {
        return view('back.maker.show', compact('maker'));
    }

    public function edit(Maker $maker)
    {
        return view('back.maker.edit', compact('maker'));
    }

    public function update(UpdateMakerRequest $request, Maker $maker)
    {
        $maker->fill($request->all())->save();

        return redirect(route('back.makers.show', $maker));
    }
}
