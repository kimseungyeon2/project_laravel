<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_votes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('content_id')->unsigned();
          $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade')->onUpdate('cascade');
          $table->string('vote_content');
          $table->integer('vote_point')->unsigned()->default(1);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_votes');
    }
}
