<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationToUsersTable extends Migration
{
    /**
     * Run the migrations.
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
