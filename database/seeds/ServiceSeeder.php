<?php

use App\Imports\ServicesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ServicesImport, 'public/excel_bases/services_import.xlsx');
    }
}
