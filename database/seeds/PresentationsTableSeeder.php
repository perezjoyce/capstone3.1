<?php

use Illuminate\Database\Seeder;
use App\Presentation;

class PresentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentation::insert([
        	['name' => 'Multiple Choice', 'instruction' => 'Choose the best answer.', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Matching Type', 'instruction' => 'Match each question in column A with the correct answer in column B.', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Fill In The Blanks', 'instruction' => 'Write the correct answer in the space provided.', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'True Or False', 'instruction' => 'Determine if the statement is true or false.', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
