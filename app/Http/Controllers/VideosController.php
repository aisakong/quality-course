<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

use App\Video;

class VideosController extends Controller
{
    public function show(Video $video)
    {
        $videoList = Video::where('series_id', $video->series_id)
            ->orderBy('id', 'asc')
            ->get();

        return view('videos.show', compact('video', 'videoList'));
    }
}
