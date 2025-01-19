<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgeToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 年齢を追加
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('age')->after('department'); // departmentの後に追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 年齢を削除
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }
}
