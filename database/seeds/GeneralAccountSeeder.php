<?php

use App\Imports\GeneralAccountsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class GeneralAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new GeneralAccountsImport, 'public/storage/imports/general_accounts_import.xlsx');
    }
}
