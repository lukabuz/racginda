<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_replies', function (Blueprint $table) {
            $table->increments('id');

            $table->mediumText('description');

            $table->unsignedInteger('submission_id');
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            
            $table->string('cookie');
            $table->string('user-agent');
            $table->string('ip');

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
        Schema::dropIfExists('submission_replies');
    }
}
