<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // ログインフォーム表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // ログイン認証
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('employees.index');  // ログイン後、従業員一覧ページへリダイレクト
        }

        // 認証失敗
        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
    }

    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');  // ログアウト後、ログインページへリダイレクト
    }
}
