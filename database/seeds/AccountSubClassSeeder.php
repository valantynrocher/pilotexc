<?php

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AccountSubClassImport;
use Illuminate\Database\Seeder;

class AccountSubClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new AccountSubClassImport, 'public/excel_bases/account_subclasses_import.xlsx');
    }
}
