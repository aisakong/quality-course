<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('student_id')->nullable();
            $table->boolean('validated')->default(false);

            $table->string('college')->nullable();
            $table->string('major')->nullable();
            $table->string('class')->nullable();
            $table->string('sex')->nullable();
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
            $table->dropColumn('student_id');
            $table->dropColumn('validated');
            $table->dropColumn('college');
            $table->dropColumn('major');
            $table->dropColumn('class');
            $table->dropColumn('sex');
        });
    }
}
