<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountClassSeeder::class);
        $this->call(AccountSubClassSeeder::class);
        $this->call(Cerfa1GroupSeeder::class);
        $this->call(Cerfa1LineSeeder::class);
        $this->call(GeneralAccountSeeder::class);
        $this->call(StructureSeeder::class);
        $this->call(FolderSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(AnalyticAccountSeeder::class);
    }
}
