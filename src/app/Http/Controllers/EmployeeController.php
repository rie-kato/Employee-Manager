<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
public function index(Request $request)
{
    // 例：`search` パラメータが存在する場合にリダイレクト
    if ($request->filled('search')) {
        return redirect('/');
    }

    $employees = Employee::query();

    // 検索機能
    if ($request->filled('search')) {
        $employees->where('name', 'like', '%' . $request->search . '%');
    }

    // 並び順
    if ($request->input('sort') === 'asc') {
        $employees->orderBy('id', 'asc');
    }

    // ページネーション (1ページあたり10件)
    $employees = $employees->paginate(10);

    return view('employees.index', [
        'employees' => $employees,
    ]);
}



    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.show', [
            'employee' => $employee,
        ]);
    }
}
