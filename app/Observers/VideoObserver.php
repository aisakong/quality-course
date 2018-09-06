<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Observers;

use App\Video;
use DB;
use FFMpeg\FFProbe;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class VideoObserver
{
    public function created(Video $video)
    {
        $video->series->increment('video_count', 1);
    }

    public function deleted(Video $video)
    {
        $video->series->decrement('video_count', 1);
    }

    public function saved(Video $video)
    {
        $ffprobe = FFProbe::create([
            'ffprobe.binaries' => config('services.ffprobe.binaries'),
        ]);

        $length = $ffprobe
            ->streams('uploads/'.$video->src)
            ->videos()
            ->first()
            ->get('duration');

        DB::table('videos')->where('id', $video->id)
            ->update(['length' => $length]);
    }
}
