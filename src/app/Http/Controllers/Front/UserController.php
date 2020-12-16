<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Front\User;
use App\Http\Requests\Front\UpdateUserRequest;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('front.user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('front.user.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->all())->save();

        return redirect(route('users.show', $user->id));
    }

    public function confirmWithdraw(User $user)
    {
        return view('front.user.confirm_withdraw', ['user' => $user]);
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
