<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Front\User;
use App\Models\Back\Category;
use App\Http\Requests\Front\UpdateUserRequest;

class UserController extends Controller
{
    public function show(User $user)
    {
        $categories = Category::all();
        return view('front.user.show', compact('user', 'categories'));
    }

    public function edit(User $user)
    {
        $categories = Category::all();
        return view('front.user.edit', compact('user', 'categories'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->all())->save();

        return redirect(route('users.show', $user->id));
    }

    public function confirmWithdraw(User $user)
    {
        $categories = Category::all();
        return view('front.user.confirm_withdraw', compact('user', 'categories'));
    }

    public function destroy(User $user)
    {
        // TODO: 論理削除
        Auth::logout();
        User::destroy($user->id);

        return redirect(route('users.withdrawal.complete'));
    }

    public function completeWithdrawal()
    {
        return view('front.user.complete_withdrawal');
    }
}
