@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<style>
  th {
    background-color: #289ADC;
    color: white;
    padding: 5px 40px;
  }

  tr:nth-child(odd) td {
    background-color: #FFFFFF;
  }

  td {
    padding: 25px 40px;
    background-color: #EEEEEE;
    text-align: center;
  }

  svg.w-5.h-5 {
    /* paginateメソッドの矢印の大きさ調整のために追加 */
    width: 30px;
    height: 30px;
  }
</style>
@endsection

@section('content')
    <!-- メインコンテンツ部分 -->
    <div class="content">
        <!-- サイドバー部分 -->
        <div class="sidebar">
            <form class="sidebar__search" action="{{ route('employees.index') }}" method="GET">
                <input type="text" name="search" class="sidebar__search-box" placeholder="従業員名を検索" value="{{ request('search') }}">
                <button type="submit" class="sidebar__search-button">検索</button>
            </form>
            <div class="sidebar__sort">
                <a href="{{ route('employees.index', ['sort' => 'asc']) }}" class="sidebar__sort-button">社員番号（昇順）</a>
            </div>
            <ul class="sidebar__list">
                @foreach ($employees as $emp)
                <li class="sidebar__item {{ request('id') == $emp->id ? 'active' : '' }}">
                    <a href="{{ route('employees.index', ['id' => $emp->id]) }}" class="sidebar__employee-link">
                        社員番号 {{ $emp->id }}: {{ $emp->name }}
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- ページネーションリンク -->
            <div class="pagination">
                {{ $employees->links() }}
            </div>
        </div>

        <!-- 従業員詳細部分 -->
        <div class="employee-detail">
            @if ($employee)
            <h2>{{ $employee->name }} の詳細</h2>
            <ul class="employee-detail-list">
                <li><strong>社員番号:</strong> {{ $employee->id }}</li>
                <li><strong>氏名:</strong> {{ $employee->name }}</li>
                <li><strong>部署:</strong> {{ $employee->department }}</li>
                <li><strong>年齢:</strong> {{ $employee->age }} 歳</li>
            </ul>
            @else
            <p>詳細情報が選択されていません。</p>
            @endif
        </div>

        <!-- 従業員追加、編集、削除部分（認証が必要） -->
        @auth
        <div class="employee-action">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- 従業員追加 -->
            <form action="{{ route('employees.store') }}" method="POST" class="action-form">
                @csrf
                <h3>従業員追加</h3>
                <input type="text" name="name" placeholder="名前を入力" required>
                <input type="text" name="department" placeholder="部署を入力" required>
                <input type="number" name="age" placeholder="年齢を入力" required>
                <button type="submit">追加</button>
            </form>

            <!-- 従業員編集 -->
            @if ($employee)
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="action-form">
                @csrf
                @method('PUT')
                <h3>従業員編集</h3>
                <input type="text" name="name" value="{{ $employee->name }}" required>
                <input type="text" name="department" value="{{ $employee->department }}" required>
                <input type="number" name="age" value="{{ $employee->age }}" required>
                <button type="submit">更新</button>
            </form>
            @endif

            <!-- 従業員削除 -->
            @if ($employee)
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="action-form">
                @csrf
                @method('DELETE')
                <h3>従業員削除</h3>
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
            @endif
        </div>
        @endauth

        <!-- 未ログインユーザーへのメッセージ -->
        @guest
        <p class="alert alert-info">ログインすると、従業員の追加や編集ができます。</p>
        @endguest
    </div>
@endsection