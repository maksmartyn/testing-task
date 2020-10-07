<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsInUserWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_workers');
        Schema::create('user_workers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('worker_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->primary(['user_id','worker_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workers');
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
            $table->primary('id');
        });
    }
}
