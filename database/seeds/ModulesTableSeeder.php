<?php

use Illuminate\Database\Seeder;
use App\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::insert([
        	['name' => 'Numbers & Number Sense', 'subject_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Geometry', 'subject_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Patterns & Algebra', 'subject_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Measurement', 'subject_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Statistics & Probability', 'subject_id' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Matter', 'subject_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Living Things & Their Environment', 'subject_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Force & Motion', 'subject_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Earth & Space', 'subject_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Force, Motion & Energy', 'subject_id' => 2, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Listening Comprehension', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Oral Language', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Vocabulary Development', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Reading Comprehension', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Study Strategy Research', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grammar', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Writing Composition', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Viewing', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Literature', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Oral Language & Fluency', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Grammar Awareness', 'subject_id' => 3, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Pagsasalita (Gramatika)', 'subject_id' => 4, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Pagbasa (Pag-unlad ng Talasalitaan)', 'subject_id' => 4, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Paglinang ng Talasalitaan', 'subject_id' => 4, 'created_at' => NULL, 'updated_at' => NULL],
        	['name' => 'Wika at Gramatika', 'subject_id' => 4, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Aking Bansa', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Lipunan, Kultura, at Ekonomiya ng Aking Bansa', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Pamamahala Sa Aking Bansa', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Kabahagi Ako sa Pag-unlad ng Aking Bansa', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Pinagmulan ng Lahing Pilipino', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Pamunuang Kolonyal ng Espanya (Ika-16 Hanggang Ika-17 Siglo)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Pagbabagong Kultural sa Pamamahalang Kolonyal ng mga Espanyol', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Pagbabago sa Kolonya at Pag-usbong ng Pakikibaka ng Bayan (Ika-18 Daantaon Hanggang 1815)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Kinalalagyan ng Pilipinas at ang Malayang Kaisipan sa Mundo', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Pagpupunyagi sa Panahon ng Kolonyalismong Amerikano at Ikalawang Digmaang Pandaigdig (1899-1945)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Pagtugon sa mga Suliranin, Isyu, at Hamon sa Kasarinlan ng Bansa (1946-1972)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Tungo sa Pagkamit ng Tunay na Demokrasya at Kaunlaran (1972-Kasalukuyan)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Heograpiya ng Asya', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Sinaunang Kabihasnan sa Asya Hanggang sa Ika-16 na Siglo', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Timog at Kanlurang Asya sa Transisyonal at Makabagong Panahon (ika-16 hanggang ika-20 siglo)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Silangan at Timog-Silangang Asya sa Transisyonal at Makabagong Panahon (ika-16 hanggang ika-20 siglo)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Heograpiya at Mga Sinaunang Kabihasnan sa Daigdig', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Daigdig sa Klasiko at Transisyonal na Panahon', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Pag-usbong ng Makabagong Daigdig: Ang Transpormasyon tungo sa Pagbuo ng Pandaigdigang Kamalayan', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Ang Kontemporanyong Daigdig (ika-20 siglo hanggang sa kasalukuyan): Mga Suliranin at Hamon tungo sa Pandaigdigang Kapayapaan, Pagkakaisa, Pagtutulungan, at Kaunlaran', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Pangunahing Konsepto ng Ekonomiks: Batayan ng Matalinong Paggamit ng Pinagkuknang Yaman tungo sa Pagkamit ng Kaunlaran', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Maykroekonomiks', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Makroekonomiks', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Sektor Pang-Ekonomiya at Mga Patakarang Pang-Ekonomiya Nito', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Isyung Pangkapaligiran at Pang-ekonomiya', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Isyung Pulitikal at Pangkapayapaan', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Isyu sa Karapatang Pantao at Gender', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL],
        	// ['name' => 'Mga Isyung Pang-Edukasyon at Pansibiko at Pagkamamamayan (Civics and Citizenship)', 'subject_id' => 5, 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
