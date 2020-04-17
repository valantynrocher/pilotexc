<?php

use App\AccountClass;
use Illuminate\Database\Seeder;

class AccountClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountClass::create([
            'id' => 1,
            'name' => 'Comptes de Capitaux',
            'summary_report' => 'Bilan'
        ]);
        AccountClass::create([
            'id' => 2,
            'name' => 'Comptes d\'Immobilisation',
            'summary_report' => 'Bilan'
        ]);
        AccountClass::create([
            'id' => 3,
            'name' => 'Comptes de Stocks',
            'summary_report' => 'Bilan'
        ]);
        AccountClass::create([
            'id' => 4,
            'name' => 'Comptes de Tiers',
            'summary_report' => 'Bilan'
        ]);
        AccountClass::create([
            'id' => 5,
            'name' => 'Comptes Financiers',
            'summary_report' => 'Bilan'
        ]);
        AccountClass::create([
            'id' => 6,
            'name' => 'Comptes de charges',
            'summary_report' => 'Compte de résultat'
        ]);
        AccountClass::create([
            'id' => 7,
            'name' => 'Comptes de produits',
            'summary_report' => 'Compte de résultat'
        ]);
        AccountClass::create([
            'id' => 8,
            'name' => 'Contributions Volontaires en Nature (CVN)',
            'summary_report' => 'Compte de résultat'
        ]);
    }
}
