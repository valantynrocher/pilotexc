<?php

use App\Structure;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Structure::create([
            'id' => 1,
            'name' => 'VOUVANT'
        ]);
        Structure::create([
            'id' => 2,
            'name' => 'TOTU'
        ]);
        Structure::create([
            'id' => 3,
            'name' => 'FOL'
        ]);
    }
}
