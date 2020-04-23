<?php

use App\Imports\Cerfa1LinesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class Cerfa1LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new Cerfa1LinesImport, 'public/excel_bases/cerfa1_lines_import.xlsx');
    }
}
