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
        $this->call(GeneralAccountSeeder::class);
        $this->call(AnalyticAccountSeeder::class);
        $this->call(AnalyticEntriesSeeder::class);
    }
}
