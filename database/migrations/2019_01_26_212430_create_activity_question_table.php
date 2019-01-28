<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('question_id'); 
            $table->integer('item_number');
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('activity_id')
            ->references('id')
            ->on('activities')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('question_id')
            ->references('id')
            ->on('questions')
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
        Schema::dropIfExists('activity_question');
    }
}
