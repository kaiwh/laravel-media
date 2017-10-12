<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_to_categories', function (Blueprint $table) {
            $table->integer('media_id')->unsigned();
            $table->foreign('media_id')->references('id')->on('media');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('media_categories');
            $table->primary(['media_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_to_categories');
    }
}
