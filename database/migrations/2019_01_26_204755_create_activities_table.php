<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('chapter_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('purpose_id');
            $table->unsignedInteger('presentation_id');
            $table->integer('number_of_items');
            $table->date('deadline');
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('section_id')
            ->references('id')
            ->on('sections')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('purpose_id')
            ->references('id')
            ->on('purposes')
            ->onDelete('restrict')
            ->onUpdate('cascade');   
            
            $table->foreign('presentation_id')
            ->references('id')
            ->on('presentations')
            ->onDelete('restrict')
            ->onUpdate('cascade');     
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
