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
        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(LevelsTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(PurposesTableSeeder::class);
        // $this->call(PresentationsTableSeeder::class);
        // $this->call(ModulesTableSeeder::class);
        // $this->call(ChaptersTableSeeder::class); //NOT YET SEEDED
        // $this->call(QuestionsTableSeeder::class); //NOT YET SEEDED
        // $this->call(AnswersTableSeeder::class); //NOT YET SEEDED
        $this->call(SectionsTableSeeder::class); 
    }
}
