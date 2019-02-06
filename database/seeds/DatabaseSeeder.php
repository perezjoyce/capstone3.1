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
//         $this->call(UsersTableSeeder::class);
//         $this->call(CategoriesTableSeeder::class);
//         $this->call(SubjectsTableSeeder::class);
//         $this->call(PurposesTableSeeder::class);
//         $this->call(PresentationsTableSeeder::class);


//         $this->call(LevelsTableSeeder::class);// AFTER LEVELS
//         $this->call(ModulesTableSeeder::class); // AFTER SUBJECT
         $this->call(SectionsTableSeeder::class);


//         $this->call(TopicsTableSeeder::class); // AFTER MODULES

//         $this->call(ChaptersTableSeeder::class); //AFTER TOPICS

        // $this->call(QuestionsTableSeeder::class); //no data yet
        // $this->call(AnswersTableSeeder::class); // no data yet

    }
}
