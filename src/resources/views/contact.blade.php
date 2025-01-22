@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
    <h1>お問い合わせ</h1>

    {{-- フラッシュメッセージ表示 --}}
    @if (session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="message">メッセージ</label>
            <textarea name="message" id="message" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
@endsection
