<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'series_id', 'view_count', 'src', 'length', 'body', 'order'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function prev()
    {
        $video = self::where([
            ['series_id', '=', $this->series_id],
            ['id', '<', $this->id],
        ])
            ->orderBy('id', 'desc')
            ->first(['id', 'title']);

        return $video;
    }

    public function next()
    {
        $video = self::where([
            ['series_id', '=', $this->series_id],
            ['id', '>', $this->id],
        ])
            ->orderBy('id', 'asc')
            ->first(['id', 'title']);

        return $video;
    }
}
