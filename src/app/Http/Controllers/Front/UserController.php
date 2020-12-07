<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function show(User $user)
    {
        if (!$this->isHimself($user)) {
            abort(404);
        }

        return view('front.user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        if (!$this->isHimself($user)) {
            abort(404);
        }

        return view('front.user.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$this->isHimself($user)) {
            abort(404);
        }

        $user->fill($request->all())->save();

        return redirect(route('user.show', $user->id));
    }

    private function isHimself(User $user)
    {
        return ($user->id === auth()->user()->id);
    }
}
