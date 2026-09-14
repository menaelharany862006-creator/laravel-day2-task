<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');
        $key = 'Tables_in_' . $dbName;
        $tableNames = [];

        foreach ($tables as $table) {
            $tableNames[] = $table->$key;
        }

        return view('tables.index', compact('tableNames'));
    }

    public function show($tableName)
    {
        $rows = DB::table($tableName)->get();
        return view('tables.show', compact('tableName', 'rows'));
    }
}
