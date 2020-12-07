<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        if ($user->id !== auth()->user()->id) {
            return view('front.user.show', ['user' => auth()->user()]);
        }

        return view('front.user.show', ['user' => $user]);
    }
}
