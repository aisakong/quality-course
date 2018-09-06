@extends('layouts.app')

@section('title', '课程')

@section('content')
    <div class="container top">
        <br>
        <br>
        
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $series->title }}</h1>
            </div>
        </div>

        <br>

        <div class="row">
            <ul class="pull-left col-md-8">
                <li class="col-md-4">
                    <p class="key">难度</p>
                    <p class="value">初级</p>
                </li>
                <li class="col-md-4">
                    <p class="key">时长</p>

                    <p class="value">共 {{ $series->video_count }} 节</p>
                </li>
                <li class="col-md-4">
                    <p class="key">学习人数</p>
                    <p class="value">10038</p>
                </li>
            </ul>
        </div>

        <br>

    </div>

    <div class="body" style="padding-bottom:100px">
        <div class="container">
            <div class="row">
                <div class="col-md-8 course-info">
                    <h2>课程介绍</h2>
                    <p>{{ $series->introduction }}</p>                
                    <hr>

                    <h2>课程提纲</h2>

                    <ul>
                        @foreach($series->videos as $video)
                            <li>
                                <a href="{{ route('videos.show', $video->id) }}"><i class="fa fa-play-circle block pull-left" aria-hidden="true"></i></a>
                                <a href="{{ route('videos.show', $video->id) }}" class="title">
                                    <h3>{{ $video->title }}</h3>
                                    <span class="pull-right">{{ date('i:s', $video->length) }}</span>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-3 col-md-offset-1 siderbar">
                    <a href="{{ route('videos.show', $series->videos()->first()) }}" class="start-btn">开始学习</a>

                    <hr>
                    
                    <div class="update-info">
                        <h4>更新状态</h4>
                        <hr>
                        <p>发布于：<span title="{{ $series->created_at }}">{{ $series->created_at->diffForHumans() }}</span></p>
                        <p>更新于：<span title="{{ $series->updated_at }}">{{ $series->updated_at->diffForHumans() }}</span></p>
                    </div>

                    <div class="other-course">
                        <h4>推荐课程</h4>
                        <hr>
                        <ul>
                            @foreach($rcmdSeries as $item)
                                <li>
                                    <a href="">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <img src="{{ env('APP_URL') }}/uploads/{{ $item->thumb }}" alt="" style="border-radius: 3px;">
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <h5>{{ $item->title }}</h5>
                                                <span>{{ $item->video_count }} LESSONS</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>

        </div>
    </div>

@stop