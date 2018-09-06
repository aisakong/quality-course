@extends('layouts.app')

@section('title', '视频')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md12 col-sm-12 col-xs-12" style="padding:0;">
            <div class="panel panel-default">
                <div class="panel-body player-panel">
                    <div id="dplayer"></div>
                </div>
            </div>

            <div role="group" class="btn-group btn-group-justified">
                <div role="group" class="btn-group">
                    @if( $video->prev() )
                        <a href="{{ route('videos.show', $video->prev()->id) }}" class="btn btn-info">上一节</a>
                    @else
                        <a class="btn btn-info" disabled>已经是第一节</a>
                    @endif
                </div>
                <div role="group" class="btn-group">
                    @if( $video->next() )
                        <a href="{{ route('videos.show', $video->next()->id) }}" class="btn btn-info">下一节</a>
                    @else
                        <a class="btn btn-info" disabled>已经是最后一节</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-8 col-md-8" style="padding: 0;">
            <div class="panel panel-default article-panel">
                <div class="panel-heading">
                    <h1 class="articlt-title">
                        <span aria-hidden="true" class="glyphicon glyphicon-file"></span>
                        {{ $video->title }}
                        <!-- <div class="pull-right">
                            <div role="group" class="btn-group">
                                <a id="like-btn" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                    点赞
                                </a>
                                <span id="like-num" disabled="disabled" class="btn btn-default btn-sm">0</span>
                            </div>
                        </div> -->
                    </h1>
                    <p class="article-meta">
                        <a href="{{ route('series.index') }}"><i class="glyphicon glyphicon-book"></i> 教程 / </a>
                        <a href="">开发环境搭建 / </a>
                        <a href="#">{{ $video->title }}</a>
                    </p>
                </div>

                <div class="article-body">
                    {{ $video->body }}
                </div>

                <div class="article-footer">
                    <hr>
                    <p>最后编辑于：{{ $video->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4" style="padding-right: 0;">
            <div class="panel panel-default list-panel">
                <div class="panel-heading">
                    <h3 class="text-center">课程提纲</h3>
                </div>

                <div class="panel-body">
                    <ul>
                        @foreach($videoList as $item)
                            <li class="item">
                                <span class="position">{{ $loop->iteration }}</span>
                                <a href="{{ route('videos.show', $item->id) }}" class="{{ active_class((if_route('videos.show') && if_route_param('video', $item->id))) }}">
                                    {{ $item->title }}
                                </a>
                                <span class="length">{{ date('i:s', $item->length) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/DPlayer.min.css') }}">
@stop

@section('scripts')
    <script src="{{ asset('js/DPlayer.min.js') }}"></script>
    <script>
        const dp = new DPlayer({
            container: document.getElementById('dplayer'),
            screenshot: true,
            autoplay: true,
            video: {
                url: '/uploads/{{ $video->src }}',
            }
        });        
    </script>
@stop