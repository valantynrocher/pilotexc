<?php

use App\Imports\ScripturesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ScripturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ScripturesImport, 'public/excel_bases/scriptures_import.csv');
    }
}
