<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perform cleanup before making new entries
        DB::table('currencies')->delete();

        // Insert records to the table
        DB::table('currencies')->insert([
            ['state' => 'Netherlands', 'name' => 'Euro', 'symbol' => '€', 'iso_code' => 'EUR', 'unit' => 'Cent']
        ]);

    }
}
