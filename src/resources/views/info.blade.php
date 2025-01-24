@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/info.css') }}">
@endsection

@section('content')
    <h1>お役立ち情報</h1>
    <div class="info-sections">
        <section>
            <h2>福利厚生</h2>
            <ul>
                <li>年1回の健康診断を無料で受診できます。</li>
                <li>交通費補助: 月額2万円まで支給。</li>
                <li>住宅手当: 条件により月額1万円を支給。</li>
            </ul>
        </section>

        <section>
            <h2>手続き</h2>
            <ul>
                <li>有給申請は社内ポータルから。</li>
                <li>給与明細は「給与情報」で確認可能。</li>
            </ul>
        </section>

        <section>
            <h2>スキルアップ</h2>
            <ul>
                <li>オンライン学習サービスを無料提供。</li>
                <li>資格試験の受験料を全額負担。</li>
            </ul>
        </section>
    </div>
    <p>
        <img src="{{ asset('img/info.webp') }}" alt="お役立ち情報" class="info-image">
    </p>
    <p>
        詳細は <a href="/contact">お問い合わせ</a> ください。
    </p>
@endsection
