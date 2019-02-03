<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Section::insert([
        	['name' => 'Class 1', 'school_year' => '2017 - 2018', 'level_id' => 1, 'subject_id' => 1, 'access_code' => 'ABC123', 'status' => 'archived', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Class 2', 'school_year' => '2017 - 2018', 'level_id' => 2, 'subject_id' => 2, 'access_code' => 'EFG123', 'status' => 'archived', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Class 3', 'school_year' => '2018 - 2019', 'level_id' => 3, 'subject_id' => 2, 'access_code' => 'HIJ123', 'status' => 'active', 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Class 4', 'school_year' => '2018 - 2019', 'level_id' => 4, 'subject_id' => 3, 'access_code' => 'LMN123', 'status' => 'active', 'created_at' => NULL, 'updated_at' => NULL],
        	
        ]);
    }
}
 