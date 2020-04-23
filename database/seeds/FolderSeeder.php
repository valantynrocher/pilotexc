<?php

use App\Folder;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Folder::create([
            'id' => 1,
            'name' => 'Pôle vacances'
        ]);
        Folder::create([
            'id' => 2,
            'name' => 'PARSA'
        ]);
        Folder::create([
            'id' => 3,
            'name' => 'Costumes'
        ]);
        Folder::create([
            'id' => 4,
            'name' => 'Administration générale'
        ]);
    }
}
