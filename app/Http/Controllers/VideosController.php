<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

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
