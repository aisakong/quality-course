<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;

class PagesController extends Controller
{
    public function root()
    {
        $recent_courses = Series::take(4)->get();

        return view('pages.root', compact('recent_courses'));
    }
}
