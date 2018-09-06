<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoReferences extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            // 当 series_id 对应的 series 表数据被删除时，删除词条
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['series_id']);
        });
    }
}
