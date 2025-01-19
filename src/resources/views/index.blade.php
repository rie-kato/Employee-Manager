@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="sidebar">
    <form class="sidebar__search" action="{{ route('employees.index') }}" method="GET">
        <input type="text" name="search" class="sidebar__search-box" placeholder="従業員名を検索" value="{{ request('search') }}">
        <button type="submit" class="sidebar__search-button">検索</button>
    </form>
    <div class="sidebar__sort">
        <a href="{{ route('employees.index', ['sort' => 'asc']) }}" class="sidebar__sort-button">社員番号（昇順）</a>
    </div>
    <ul class="sidebar__list">
        @foreach ($employees as $employee)
        <li class="sidebar__item">
            <a href="{{ route('employees.show', $employee->id) }}" class="sidebar__employee-link">
                社員番号 {{ $employee->id }}: {{ $employee->name }}
            </a>
        </li>
        @endforeach
    </ul>

    <!-- ページネーションリンク -->
    <div class="pagination">
        {{ $employees->links() }}
    </div>
</div>

<div class="main">
    <p>従業員を選択してください。</p>
</div>
@endsection
