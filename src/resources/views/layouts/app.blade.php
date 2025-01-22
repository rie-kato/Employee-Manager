<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-Manager</title>
    
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    
    @yield('css')
</head>

<body>
    <!-- ヘッダー -->
 <header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
            Employee-Manager
        </a>
        <nav class="header__nav">
            <ul class="header__nav-list">
                <li class="header__nav-item">
                    <a class="header__nav-link" href="/info">お役立ち情報</a>
                </li>
                <li class="header__nav-item">
                    <a class="header__nav-link" href="/contact">お問い合わせ</a>
                </li>
                @auth
                    <li class="header__nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="header__nav-link">ログアウト</button>
                        </form>
                    </li>
                @else
                    <li class="header__nav-item">
                        <a class="header__nav-link" href="/login">ログイン</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>
</body>

</html>
