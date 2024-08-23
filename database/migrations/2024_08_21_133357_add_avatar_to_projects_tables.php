<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Получаем все таблицы, которые соответствуют шаблону `admin_table_projects%`
        $tables = DB::select("SHOW TABLES LIKE 'admin_table_projects%'");

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];

            // Исключаем таблицы, которые не являются основными таблицами проектов
            if (strpos($tableName, 'admin_table_projects_quest') === false) {
                Schema::table($tableName, function (Blueprint $table) {
                    if (!Schema::hasColumn($table->getTable(), 'avatar')) {
                        $table->string('avatar')->nullable()->after('role');
                    }
                });
            }
        }
    }

    public function down()
    {
        $tables = DB::select("SHOW TABLES LIKE 'admin_table_projects%'");

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];

            // Исключаем таблицы, которые не являются основными таблицами проектов
            if (strpos($tableName, 'admin_table_projects_quest') === false) {
                Schema::table($tableName, function (Blueprint $table) {
                    if (Schema::hasColumn($table->getTable(), 'avatar')) {
                        $table->dropColumn('avatar');
                    }
                });
            }
        }
    }
};
