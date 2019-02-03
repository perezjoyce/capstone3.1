<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('objective');
            $table->text('discussion');
            $table->text('example');
            $table->text('guided_practice');
            $table->text('tip');
            $table->text('key_point');
            $table->unsignedInteger('topic_id');
            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('topic_id')
            ->references('id')
            ->on('topics')
            ->onDelete('cascade')
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
        Schema::dropIfExists('chapters');
    }
}
