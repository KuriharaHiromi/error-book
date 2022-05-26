<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_lists', function (Blueprint $table) {
            $table->bigIncrements('error_id');
            $table->unsignedBigInteger('languages_id');
            $table->unsignedBigInteger('user_id');
            $table->string('error_name');
            $table->string('overview');
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
        Schema::dropIfExists('error_lists');
    }
}
