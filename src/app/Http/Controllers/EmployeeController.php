<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * コンストラクタ
     * 認証が必要な操作を制御 (indexメソッド以外は認証が必要)
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * トップ画面の表示
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 検索条件の適用
        $employees = Employee::query();

        if ($request->filled('search')) {
            $employees->where('name', 'like', '%' . $request->search . '%');
        }

        // ソート条件の適用
        if ($request->input('sort') === 'asc') {
            $employees->orderBy('id', 'asc');
        }

        // ページネーション
        $employees = $employees->paginate(10);

        // 指定されたIDの従業員詳細を取得
        $employee = null;
        if ($request->has('id')) {
            $employee = Employee::find($request->id);

            // 無効なIDの場合のエラー処理
            if (!$employee) {
                return redirect()->route('employees.index')
                                 ->with('error', '従業員が見つかりません');
            }
        }

        // ビューにデータを渡して表示
        return view('employees.index', [
            'employees' => $employees,
            'employee' => $employee,
        ]);
    }

    /**
     * 従業員の追加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 入力値のバリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        // データベースに新しい従業員を登録
        Employee::create($request->all());

        return redirect()->route('employees.index')
                         ->with('success', '従業員を追加しました');
    }

    /**
     * 従業員情報の更新
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // 入力値のバリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        // 指定された従業員を取得して更新
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employees.index')
                         ->with('success', '従業員情報を更新しました');
    }

    /**
     * 従業員の削除
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // 指定された従業員を取得して削除
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', '従業員を削除しました');
    }
}
