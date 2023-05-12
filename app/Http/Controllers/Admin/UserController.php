<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => '*Заполните это поле',
            'password.required' => '*Заполните это поле',
        ]);

        if (auth('admin')->attempt($data)) {
            return redirect()->route('admin-categoriesPage');
        } else {
            return redirect()->back()->with('error', 'Неверный логин или пароль');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('mainPage');
    }
}
