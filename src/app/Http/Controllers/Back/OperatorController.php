<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Back\Operator;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\Back\OperatorSearchRequest;

class OperatorController extends Controller
{
    public function menu()
    {
        return view('back.operator.menu');
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $query = Operator::query();
        if (!is_null($name)) $query->where('name', 'LIKE', "%{$name}%");
        if (!is_null($email)) $query->where('email', 'LIKE', "%{$email}%");

        $operators = $query->paginate(10);

        return view('back.operator.search', compact('operators', 'name', 'email'));
    }
}
