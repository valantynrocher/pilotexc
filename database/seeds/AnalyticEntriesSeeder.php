<?php

use App\Imports\AnalyticEntriesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AnalyticEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new AnalyticEntriesImport, 'public/excel_bases/analytics_entries_import.xlsx');
    }
}
