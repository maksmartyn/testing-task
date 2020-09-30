<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login');
            $table->string('name');
            $table->string('email');
            $table->string('image');
            $table->string('about');
            $table->string('type');
            $table->string('github');
            $table->bigInteger('worker_id', false, true);
            $table->foreign('worker_id')->references('id')->on('workers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_workers', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
        });
        Schema::dropIfExists('user_workers');
    }
}
