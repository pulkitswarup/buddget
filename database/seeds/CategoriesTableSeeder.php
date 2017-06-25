<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perform cleanup before making new entries
        DB::table('categories')->delete();

        // Insert records to the table
        DB::table('categories')->insert([
            ['id' => 1, 'label' => 'Grocery', 'priority' => 1],
            ['id' => 2, 'label' => 'Travel / Leseiure', 'priority' => 2],
            ['id' => 3, 'label' => 'Medical / Doctor', 'priority' => 3],
            ['id' => 4, 'label' => 'Clothing', 'priority' => 4],
            ['id' => 5, 'label' => 'Personal', 'priority' => 5],
            ['id' => 6, 'label' => 'Rent', 'priority' => 6],
            ['id' => 7, 'label' => 'Premium', 'priority' => 7],
            ['id' => 8, 'label' => 'Installment', 'priority' => 8],
            ['id' => 9999, 'label' => 'Others', 'priority' => 9999]
        ]);
    }
}
