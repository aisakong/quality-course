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

use App\Series;

class PagesController extends Controller
{
    public function root()
    {
        $recent_courses = Series::take(4)->get();

        return view('pages.root', compact('recent_courses'));
    }
}
