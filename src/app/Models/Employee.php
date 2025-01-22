<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // 使用するテーブル
    protected $table = 'employees';

    // 一括代入可能なカラム
    protected $fillable = [
        'name',
        'department',
        'age',
    ];
}
