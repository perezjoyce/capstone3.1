<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('module_id');
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('level_id')
            ->references('id')
            ->on('levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('module_id')
            ->references('id')
            ->on('modules')
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
        Schema::dropIfExists('topics');
    }
}
