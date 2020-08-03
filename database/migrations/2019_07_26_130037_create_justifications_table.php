<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJustificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('support_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('description');
            $table->timestamps();

            $table->foreign('support_id')->references('id')->on('supports');
            $table->foreign('user_id')->references("id")->on("admin.users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justifications');
    }
}
