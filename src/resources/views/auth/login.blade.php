@extends('layouts.app')

@section('content')
<div class="login-form__content">
    <div class="form">
        <h2 class="login-form__heading">ログイン</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form__group">
                <label for="email" class="form__group-title">メールアドレス</label>
                <input type="email" name="email" required class="form__input--text">
                @error('email')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form__group">
                <label for="password" class="form__group-title">パスワード</label>
                <input type="password" name="password" required class="form__input--text">
                @error('password')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form__button">
                <button type="submit" class="form__button-submit">ログイン</button>
            </div>
        </form>

        <div class="register__link">
            <a href="{{ route('register') }}">新規登録はこちら</a>
        </div>
    </div>
</div>
@endsection

