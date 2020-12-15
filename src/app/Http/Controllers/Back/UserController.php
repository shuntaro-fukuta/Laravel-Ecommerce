<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Front\User;
use App\Http\Requests\Front\UpdateUserRequest;
use App\Http\Requests\Back\CreateUserRequest;

class UserController extends Controller
{
    public function menu()
    {
        return view('back.user.menu');
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');

        $query = User::query();
        if (!is_null($name)) $query->where('name', 'LIKE', "%{$name}%");
        if (!is_null($email)) $query->where('email', 'LIKE', "%{$email}%");
        if (!is_null($phone_number)) $query->where('phone_number', 'LIKE', "%{$phone_number}%");
        if (!is_null($address)) $query->where('address', 'LIKE', "%{$address}%");

        $users = $query->paginate(10);

        return view('back.user.index', compact('users', 'name', 'email', 'phone_number', 'address'));
    }

    public function show(User $user)
    {
        return view('back.user.show', compact('user'));
    }

    public function create()
    {
        return view('back.user.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->all());

        return redirect(route('back.user.show', $user));
    }

    public function edit(User $user)
    {
        return view('back.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->all())->save();

        return redirect(route('back.user.show', $user));
    }
}
