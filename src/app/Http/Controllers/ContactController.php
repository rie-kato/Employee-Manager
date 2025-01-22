<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // フォーム表示用
    public function index()
    {
        return view('contact');
    }

    // フォーム送信処理
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // フラッシュメッセージ
        session()->flash('success', 'お問い合わせありがとうございます！');

        // フォームページにリダイレクト
        return redirect()->route('contact.index');
    }
}
