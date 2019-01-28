<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('school_year');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('subject_id');
            $table->string('access_code');
            $table->enum('status', ['active', 'archived']);
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('level_id')
            ->references('id')
            ->on('levels')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects')
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
        Schema::dropIfExists('sections');
    }
}
