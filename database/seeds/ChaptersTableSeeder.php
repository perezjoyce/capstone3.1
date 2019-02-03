<?php

use Illuminate\Database\Seeder;
use App\Chapters;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Purpose::insert([
        	['objective' => '', 
        		'question' => '', 
        		'discussion' => '', 
        		'example' => '', 
        		'guided_practice' => '', 
        		'tip' => '', 
        		'key_point' => '', 
        		'topic_id' => 2253, 
        		'created_at' => NULL, 
        		'updated_at' => NULL],
        	
        ]);
    }
}


