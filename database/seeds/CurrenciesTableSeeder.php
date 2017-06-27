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
            ['id'=>1, 'state' => 'Netherlands', 'name' => 'Euro', 'symbol' => '€', 'iso_code' => 'EUR', 'unit' => 'Cent'],
            ['id'=>2, 'state' => 'United States Of America', 'name' => 'United States Dollar', 'symbol' => '$', 'iso_code' => 'USD', 'unit' => 'Cent'],
            ['id'=>3, 'state' => 'India', 'name' => 'Rupee', 'symbol' => '₹', 'iso_code' => 'INR', 'unit' => 'paisa']
        ]);

    }
}
