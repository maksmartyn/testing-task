<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')->after('id');
            $table->string('image')->after('email')->nullable();
            $table->string('about')->after('image')->nullable();
            $table->string('type')->after('about');
            $table->string('github')->after('type')->nullable();
            $table->string('city')->after('github')->nullable();
            $table->boolean('is_finished')->after('city')->nullable();
            $table->string('phone')->after('is_finished')->nullable();
            $table->timestamp('birthday')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('login');
            $table->dropColumn('image');
            $table->dropColumn('about');
            $table->dropColumn('type');
            $table->dropColumn('github');
            $table->dropColumn('city');
            $table->dropColumn('is_finished');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
        });
    }
}
