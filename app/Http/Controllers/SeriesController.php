<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();
        return view('series.index', compact('series'));
    }

    public function show(Series $series)
    {
        $rcmdSeries = Series::where('id', '!=', $series->id)->take(6)->get();
        return view('series.show', compact('series', 'rcmdSeries'));
    }
}
