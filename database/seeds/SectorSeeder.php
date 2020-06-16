<?php

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::create([
            'id' => 1,
            'name' => 'VOUVANT',
            'folder_id' => 1
        ]);
        Sector::create([
            'id' => 2,
            'name' => 'Réseau associatif',
            'folder_id' => 2
        ]);
        Sector::create([
            'id' => 3,
            'name' => 'EJF-DD',
            'folder_id' =>2
        ]);
        Sector::create([
            'id' => 4,
            'name' => 'Lire et Faire Lire',
            'folder_id' => 2
        ]);
        Sector::create([
            'id' => 5,
            'name' => 'USEP',
            'folder_id' => 2
        ]);
        Sector::create([
            'id' => 6,
            'name' => 'Costumes',
            'folder_id' => 3
        ]);
        Sector::create([
            'id' => 7,
            'name' => 'Centres Permanents',
            'folder_id' => 1
        ]);
        Sector::create([
            'id' => 8,
            'name' => 'VPT',
            'folder_id' => 1
        ]);
        Sector::create([
            'id' => 9,
            'name' => 'Administration générale',
            'folder_id' => 4
        ]);
    }
}
