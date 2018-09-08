@extends('layouts.app')
@section('title', '首页')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>综合布线</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores inventore nesciunt sit impedit nulla voluptatem asperiores aut maxime similique voluptates repellat facilis labore, accusantium sapiente eligendi non nemo quidem saepe?</p>
        
        @guest
            <p><a class="btn btn-success btn-md" href="{{ route('login') }}" role="button">立即参加</a></p>
        @else
            <p><a class="btn btn-success btn-md" href="{{ route('series.index') }}" role="button">继续学习</a></p>
        @endguest
    </div>
</div>

<div class="container">
    <h2 style="font-size: 24px;">最新教程</h2>
    <hr>
    <div class="row">
        @foreach($recent_courses as $course)
            <div class="col-md-3">
                <div class="courses">
                    <a href="{{ route('series.show', $course) }}">
                        <div class="image">
                            <img src="{{ asset('/uploads/' . $course->thumb) }}" alt="{{ $course->title }}">
                        </div>
                        <h3>{{ $course->title }}{{ $course->title }}{{ $course->title }}</h3>
                    </a>
                </div>
            </div>
        @endforeach

    </div>

    <br>
    <br>
    
    <h2 style="font-size: 24px;">最新话题</h2>
    <hr>
    <div class="row">

    </div>
</div>
@stop