<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Front\User;

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
}
