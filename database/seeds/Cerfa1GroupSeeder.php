<?php

use App\Imports\Cerfa1GroupsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class Cerfa1GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new Cerfa1GroupsImport, 'public/excel_bases/cerfa1_groups_import.xlsx');
    }
}
