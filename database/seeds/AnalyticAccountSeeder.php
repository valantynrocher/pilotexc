<?php

use App\Imports\AnalyticAccountsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AnalyticAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new AnalyticAccountsImport, 'public/storage/imports/analytics_accounts_import.xlsx');
    }
}
