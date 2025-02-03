<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthorRequest;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // `resources/views/auth/login.blade.php` を表示
    }

    public function login(AuthorRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
        return redirect()->route('calendar'); // ログイン後にカレンダーへ
        }

        return back()->withErrors(['name' => 'お名前またはパスワードが間違っています。']);
    }

    public function index()
    {
        return view('calendar'); // ✅ カレンダー画面を表示
    }

}

